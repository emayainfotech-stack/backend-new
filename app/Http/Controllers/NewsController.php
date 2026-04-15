<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\PushNotification;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
  public function index(Request $request)
{
    $query = News::with(['category', 'author']);
    
    // Filter by status
    if ($request->has('status') && in_array($request->status, ['published', 'pending', 'rejected'])) {
        $query->where('status', $request->status);
    }
    
    // Search functionality
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
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
        ]);

        $news->status = $request->status;

        if ($request->status === 'published') {
            $news->publish_at = now();
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
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:700'],
         

            'category_id' => ['required', 'exists:categories,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],

            'tags' => ['nullable', 'string'],

            // Media (form ke according)
            'media' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,mp4', 'max:10240'], // 10MB

            'send_push_notification' => ['nullable', 'boolean'],
        ]);

        // Tags convert (comma se array)
        $tags = null;
        if (! empty($data['tags'])) {
            $tags = collect(explode(',', $data['tags']))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->values()
                ->all();
        }

        // Media upload
        $mediaPath = null;
        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('news-media', 'public');
        }

        // Save data
        $news = News::create([
            'title' => $data['title'],
            'short_description' => $data['short_description'],
          

            'category_id' => (int) $data['category_id'],
            'created_by' => (int) $request->user()->id,

            'state_id' => (int) $data['state_id'],
            'city_id' => (int) $data['city_id'],

            'tags' => $tags,

            // Default values (kyunki form me nahi hai)
            'status' => 'pending',
            'publish_at' => now(),
            'is_important' => false,

            'media_path' => $mediaPath,

            'send_push_notification' => (bool) $request->boolean('send_push_notification'),
        ]);

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
            'short_description' => ['required', 'string', 'max:700'],
            
            'category_id' => ['required', 'exists:categories,id'],
            'city' => ['nullable', 'string', 'max:255'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'tags' => ['nullable', 'string'],
            'publishing_mode' => ['required', 'in:instant,schedule'],
            'publish_at' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,published,rejected'],
            'media' => ['nullable', 'file', 'max:51200'], // 50MB
            'media_type' => ['nullable', 'in:image,video'],
            'is_important' => ['nullable', 'boolean'],
            'send_push_notification' => ['nullable', 'boolean'],
        ]);

        $publishAt = null;
        if ($data['publishing_mode'] === 'schedule') {
            $publishAt = $data['publish_at'] ? Carbon::parse($data['publish_at'])->setTimezone(config('app.timezone')) : null;
        } elseif ($data['publishing_mode'] === 'instant' && $data['status'] === 'published') {
            $publishAt = Carbon::now();
        }

        $tags = null;
        if (! empty($data['tags'])) {
            $tags = collect(explode(',', $data['tags']))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->values()
                ->all();
        }

        // Handle media removal
        $mediaPath = $news->media_path;
        if ($request->has('remove_media') || $request->hasFile('media')) {
            // Remove old media if exists
            if ($news->media_path && Storage::disk('public')->exists($news->media_path)) {
                Storage::disk('public')->delete($news->media_path);
            }
            $mediaPath = null;
        }

        // Upload new media if provided
        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('news-media', 'public');
        }

        $news->update([
            'title' => $data['title'],
            'short_description' => $data['short_description'],
      
            'category_id' => (int) $data['category_id'],
            'city' => $data['city'] ?: 'Jaipur',
            'state_id' => (int) $data['state_id'],
            'city_id' => (int) $data['city_id'],
            'tags' => $tags,
            'status' => $data['status'],
            'publish_at' => $publishAt,
            'media_type' => $data['media_type'] ?? null,
            'media_path' => $mediaPath,
            'is_important' => (bool) $request->boolean('is_important'),
            'send_push_notification' => (bool) $request->boolean('send_push_notification'),
        ]);

        if ($news->send_push_notification && $news->is_important && $news->status === 'published') {
            PushNotification::create([
                'news_id' => $news->id,
                'title' => $news->title,
                'body' => $news->short_description,
                'status' => 'queued',
            ]);
        } elseif ($news->send_push_notification && ! $news->is_important) {
            PushNotification::create([
                'news_id' => $news->id,
                'title' => $news->title,
                'body' => $news->short_description,
                'status' => 'skipped',
                'error' => 'Only important news can be notified.',
            ]);
        }

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Remove associated media file
        if ($news->media_path && Storage::disk('public')->exists($news->media_path)) {
            Storage::disk('public')->delete($news->media_path);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
