<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
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
          
            'source_link' => $data['source_link'] ?? null,

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
            'media' => ['nullable', 'file', 'max:51200'],
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

        // 🔴 CASE 1: Remove button click
        if ($request->remove_media == "1") {
            if ($news->media_path && Storage::disk('public')->exists($news->media_path)) {
                Storage::disk('public')->delete($news->media_path);
            }
            $mediaPath = null;
        }

        // 🟢 CASE 2: New media upload
        if ($request->hasFile('media')) {
            // old delete
            if ($news->media_path && Storage::disk('public')->exists($news->media_path)) {
                Storage::disk('public')->delete($news->media_path);
            }
            $mediaPath = $request->file('media')->store('news-media', 'public');
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
            'media_path' => $mediaPath,
            'send_push_notification' => $request->boolean('send_push_notification'),
        ]);
    
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
