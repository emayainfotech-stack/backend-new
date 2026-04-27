<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Exception\ExecutableNotFoundException;
use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Services\FirebaseNotificationService;

class NewsController extends Controller
{
    private function publicStoragePath(string $relativePathUnderStorage): string
    {
        return public_path('storage/' . ltrim($relativePathUnderStorage, '/'));
    }

    private function ensurePublicStorageDir(string $subdir): string
    {
        $dir = public_path('storage/' . trim($subdir, '/'));
        File::ensureDirectoryExists($dir);
        return $dir;
    }

    private function moveUploadedFileToPublicStorage(\Illuminate\Http\UploadedFile $file, string $subdir): string
    {
        $dir = $this->ensurePublicStorageDir($subdir);
        $filename = now()->format('YmdHis') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return trim($subdir, '/') . '/' . $filename; // relative under /storage
    }

    private function deletePublicStorageFile(?string $relativePathUnderStorage): void
    {
        if (! $relativePathUnderStorage) return;
        $abs = $this->publicStoragePath($relativePathUnderStorage);
        if (File::exists($abs)) {
            @unlink($abs);
        }
    }

    private function generateVideoThumbnail(string $publicDiskVideoPath): ?string
    {
        // We store media directly under public/storage for shared hosting compatibility
        $videoAbsolutePath = $this->publicStoragePath($publicDiskVideoPath);

        $tmpBase = tempnam(sys_get_temp_dir(), 'news_thumb_');
        if ($tmpBase === false) {
            throw new \RuntimeException('Unable to create temporary file for thumbnail.');
        }

        // tempnam creates the file; we want a .jpg extension for ffmpeg output
        $tmpJpg = $tmpBase . '.jpg';

        try {
            try {
                $ffmpeg = FFMpeg::create([
                    // Allow overriding binaries on Windows via .env
                    'ffmpeg.binaries' => env('FFMPEG_BINARIES', 'ffmpeg'),
                    'ffprobe.binaries' => env('FFPROBE_BINARIES', 'ffprobe'),
                    'timeout' => 60,
                ]);
            } catch (ExecutableNotFoundException $e) {
                Log::warning('FFmpeg/FFprobe not found; skipping video thumbnail generation.', [
                    'video' => $publicDiskVideoPath,
                    'error' => $e->getMessage(),
                ]);
                return null;
            }

            $video = $ffmpeg->open($videoAbsolutePath);
            $video->frame(TimeCode::fromSeconds(1))->save($tmpJpg);

            $this->ensurePublicStorageDir('news-thumbnails');
            $thumbnailPath = 'news-thumbnails/' . Str::uuid() . '.jpg';
            File::put($this->publicStoragePath($thumbnailPath), file_get_contents($tmpJpg));

            return $thumbnailPath;
        } finally {
            @unlink($tmpJpg);
            @unlink($tmpBase);
        }
    }

    public function index(Request $request)
    {
        $query = News::with(['category', 'author']);

        // ✅ Quick Date Filters
        if ($request->filled('date')) {
            if ($request->date == 'today') {
                $query->whereDate('publish_at', Carbon::today());
            }

            if ($request->date == '7days') {
                $query->where('publish_at', '>=', Carbon::now()->subDays(7));
            }

            if ($request->date == '1month') {
                $query->where('publish_at', '>=', Carbon::now()->subMonth());
            }
        }

        // ✅ Custom Date Range
        if ($request->filled('date_from')) {
            $query->where('publish_at', '>=', Carbon::parse($request->date_from));
        }

        if ($request->filled('date_to')) {
            $query->where('publish_at', '<=', Carbon::parse($request->date_to));
        }

        // Status filter
        if ($request->has('status') && in_array($request->status, ['published', 'pending', 'rejected'])) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('news.index', compact('news'));
    }

    public function updateStatus(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'status' => 'required|in:published,rejected',
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $news->status = $request->status;

        if ($request->status === 'published') {
            $news->publish_at = now();
            $news->rejection_reason = null;
        } elseif ($request->status === 'rejected') {
            $news->rejection_reason = $request->rejection_reason;
        }

        $news->save();

        return back()->with('success', 'News status updated.');
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();
        $states = State::orderBy('name')->get();

        return view('news.create', compact('categories', 'states'));
    }

    public function store(Request $request)
    {
        $isAdmin = (string) optional($request->user())->role === 'admin';

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $words = preg_split('/\s+/u', trim((string) $value), -1, PREG_SPLIT_NO_EMPTY);
                    if (count($words) > 70) {
                        $fail('Description must not be greater than 70 words.');
                    }
                },
            ],


            'category_id' => ['required', 'exists:categories,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],

            'tags' => ['nullable', 'string'],
            'source_link' => ['nullable', 'url'],

            'media_type' => ['nullable', 'in:image,video'],
            'status' => [$isAdmin ? 'nullable' : 'prohibited', Rule::in(['pending', 'published'])],

            // Media (form ke according)
            'media' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,mp4', 'max:10240'], // 10MB
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5MB

            'send_push_notification' => ['nullable', 'boolean'],
        ]);

        // Tags convert (comma se array)
        $tags = null;
        if (! empty($data['tags'])) {
            $tags = collect(explode(',', $data['tags']))
                ->map(fn($t) => trim($t))
                ->filter()
                ->values()
                ->all();
        }

        // Media upload
        $mediaPath = null;
        $mediaType = null;
        $thumbnailPath = null;
        if ($request->hasFile('media')) {
            $mediaPath = $this->moveUploadedFileToPublicStorage($request->file('media'), 'news-media');

            $ext = strtolower((string) $request->file('media')->getClientOriginalExtension());
            $detectedType = $ext === 'mp4' ? 'video' : 'image';
            $mediaType = $data['media_type'] ?? $detectedType;

            // Enforce dropdown selection vs file type
            if ($mediaType === 'video' && $detectedType !== 'video') {
                throw ValidationException::withMessages([
                    'media' => 'Selected media type is Video, but uploaded file is not a video.',
                ]);
            }
            if ($mediaType === 'image' && $detectedType !== 'image') {
                throw ValidationException::withMessages([
                    'media' => 'Selected media type is Image, but uploaded file is not an image.',
                ]);
            }

            if ($mediaType === 'video') {
                if (! $request->hasFile('thumbnail')) {
                    throw ValidationException::withMessages([
                        'thumbnail' => 'Thumbnail is required when uploading a video.',
                    ]);
                }

                $thumbnailPath = $this->moveUploadedFileToPublicStorage($request->file('thumbnail'), 'news-thumbnails');

                // Safety fallback (shouldn't happen due to validation)
                if (! $thumbnailPath) {
                    $thumbnailPath = $this->generateVideoThumbnail($mediaPath);
                }
            }
        }

        $status = 'pending';
        $publishAt = null;
        if ($isAdmin && ($data['status'] ?? null) === 'published') {
            $status = 'published';
            $publishAt = now();
        }

        // Save data
        $news = News::create([
            'title' => $data['title'],
            'short_description' => $data['short_description'],

            'source_link' => $data['source_link'] ?? null,

            'category_id' => (int) $data['category_id'],
            'created_by' => (int) $request->user()->id,

            'state_id' => (int) $data['state_id'],
            'city_id' => (int) $data['city_id'],

            'tags' => $tags,

            // Default values 
            'status' => $status,
            'publish_at' => $publishAt,
            'is_important' => false,

            'media_type' => $mediaType,
            'media_path' => $mediaPath,
            'thumbnail_path' => $thumbnailPath,

            'send_push_notification' => (bool) $request->boolean('send_push_notification'),
        ]);

        if ($news->send_push_notification) {
            $tokens = DB::table('device_tokens')->pluck('token');

            foreach ($tokens as $token) {
                try {
                    Http::post('https://exp.host/--/api/v2/push/send', [
                        'to' => $token,
                        'title' => $news->title,
                        'body' => 'Test Notification',
                        'data' => [
                            'news_id' => (string) $news->id,
                        ],
                    ]);
                } catch (\Throwable $e) {
                    Log::warning('Expo push send failed', [
                        'token' => $token,
                        'news_id' => $news->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }
    
        return redirect()->route('news.index')->with('success', 'News saved successfully.');
    }

    public function edit($id)
    {
        $news = News::with(['category', 'author', 'state', 'city'])->findOrFail($id);
        $categories = Category::query()->orderBy('name')->get();
        $states = State::orderBy('name')->get();

        return view('news.edit', compact('news', 'categories', 'states'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $words = preg_split('/\s+/u', trim($value), -1, PREG_SPLIT_NO_EMPTY);
                    if (count($words) > 70) {
                        $fail('Description must not be greater than 70 words.');
                    }
                },
            ],
            'category_id' => ['required', 'exists:categories,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'tags' => ['nullable', 'string'],
            'source_link' => ['nullable', 'url'],
            'status' => ['required', 'in:pending,published,rejected'],
            'media_type' => ['nullable', 'in:image,video'],
            'media' => ['nullable', 'file', 'max:51200'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'send_push_notification' => ['nullable', 'boolean'],
        ]);

        // Tags convert (comma separated → array)
        $tags = null;
        if (!empty($data['tags'])) {
            $tags = collect(explode(',', $data['tags']))
                ->map(fn($t) => trim($t))
                ->filter()
                ->values()
                ->all();
        }

        // Media handling
        $mediaPath = $news->media_path;
        $mediaType = $news->media_type;
        $thumbnailPath = $news->thumbnail_path;

        // 🔴 CASE 1: Remove button click
        if ($request->remove_media == "1") {
            $this->deletePublicStorageFile($news->media_path);
            $this->deletePublicStorageFile($news->thumbnail_path);
            $mediaPath = null;
            $mediaType = null;
            $thumbnailPath = null;
        }

        // 🟢 CASE 2: New media upload
        if ($request->hasFile('media')) {
            // old delete
            $this->deletePublicStorageFile($news->media_path);
            $this->deletePublicStorageFile($news->thumbnail_path);
            $mediaPath = $this->moveUploadedFileToPublicStorage($request->file('media'), 'news-media');

            $ext = strtolower((string) $request->file('media')->getClientOriginalExtension());
            $detectedType = $ext === 'mp4' ? 'video' : 'image';
            $mediaType = $data['media_type'] ?? $detectedType;

            // Enforce dropdown selection vs file type
            if ($mediaType === 'video' && $detectedType !== 'video') {
                throw ValidationException::withMessages([
                    'media' => 'Selected media type is Video, but uploaded file is not a video.',
                ]);
            }
            if ($mediaType === 'image' && $detectedType !== 'image') {
                throw ValidationException::withMessages([
                    'media' => 'Selected media type is Image, but uploaded file is not an image.',
                ]);
            }
            if ($mediaType === 'video') {
                if (! $request->hasFile('thumbnail')) {
                    throw ValidationException::withMessages([
                        'thumbnail' => 'Thumbnail is required when uploading a video.',
                    ]);
                }
                $thumbnailPath = $this->moveUploadedFileToPublicStorage($request->file('thumbnail'), 'news-thumbnails');

                // Safety fallback (shouldn't happen due to validation)
                if (! $thumbnailPath) {
                    $thumbnailPath = $this->generateVideoThumbnail($mediaPath);
                }
            } else {
                $thumbnailPath = null;
            }
        }

        $news->update([
            'title' => $data['title'],
            'short_description' => $data['short_description'],
            'category_id' => $data['category_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'tags' => $tags,
            'source_link' => $data['source_link'],
            'status' => $data['status'],
            'media_type' => $mediaType,
            'media_path' => $mediaPath,
            'thumbnail_path' => $thumbnailPath,
            'send_push_notification' => $request->boolean('send_push_notification'),
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Remove associated media file
        $this->deletePublicStorageFile($news->media_path);
        $this->deletePublicStorageFile($news->thumbnail_path);

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
