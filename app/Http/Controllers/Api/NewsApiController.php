<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    private function getLimit(Request $request, int $default = 20): int
    {
        $limit = (int) $request->query('limit', $default);
        return min(50, max(1, $limit)); // safety cap
    }

    private function getPage(Request $request, int $default = 1): int
    {
        return max(1, (int) $request->query('page', $default));
    }

    public function index(Request $request)
    {
        $query = News::with(['category', 'author'])
            ->where('status', 'published');

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $paginator = $query
            ->latest()
            ->paginate(
                $this->getLimit($request, 20),
                ['*'],
                'page',
                $this->getPage($request, 1)
            );

        return response()->json([
            'success' => true,
            'data' => collect($paginator->items())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'shortSummary' => $item->short_description,
                    'imageUrl' => $item->media_type === 'video'
                        ? ($item->thumbnail_path ? asset('storage/' . $item->thumbnail_path) : null)
                        : ($item->media_path ? asset('storage/' . $item->media_path) : null),
                    'videoUrl' => $item->media_type === 'video' && $item->media_path
                        ? asset('storage/' . $item->media_path)
                        : null,
                    'url' => $item->source_link,
                    'source' => optional($item->author)->name ?? 'Admin',
                    'publishedAt' => $item->publish_at,
                    'category' => optional($item->category)->slug,
                    'readTime' => '2 min',
                ];
            }),
            'meta' => [
                'page' => $paginator->currentPage(),
                'limit' => $paginator->perPage(),
                'total' => $paginator->total(),
                'lastPage' => $paginator->lastPage(),
            ],
        ]);
    }



     public function search(Request $request)
    {
        $query = $request->q;
    
        $builder = News::with(['category', 'city', 'state'])
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('short_description', 'LIKE', "%{$query}%")
                  
                  // CATEGORY RELATION FIX
                  ->orWhereHas('category', function ($cat) use ($query) {
                      $cat->where('name', 'LIKE', "%{$query}%");
                  })

                  // CITY SEARCH
                  ->orWhereHas('city', function ($city) use ($query) {
                      $city->where('name', 'LIKE', "%{$query}%");
                  });
            })
            ->latest();

        $paginator = $builder->paginate(
            $this->getLimit($request, 20),
            ['*'],
            'page',
            $this->getPage($request, 1)
        );

        return response()->json([
            'status' => true,
            'data' => collect($paginator->items())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'shortSummary' => $item->short_description,
                    'imageUrl' => $item->media_type === 'video'
                        ? ($item->thumbnail_path ? asset('storage/' . $item->thumbnail_path) : null)
                        : ($item->media_path ? asset('storage/' . $item->media_path) : null),
                    'videoUrl' => $item->media_type === 'video' && $item->media_path
                        ? asset('storage/' . $item->media_path)
                        : null,
                    'url' => $item->source_link,
                    'source' => optional($item->author)->name ?? 'Unknown',
                    'publishedAt' => $item->publish_at,
                    'category' => optional($item->category)->name ?? 'general',
                ];
            }),
            'meta' => [
                'page' => $paginator->currentPage(),
                'limit' => $paginator->perPage(),
                'total' => $paginator->total(),
                'lastPage' => $paginator->lastPage(),
            ],
        ]);
    }



    public function notifications()
    {
        $news = \App\Models\News::where('send_push_notification', true)
            ->latest()
            ->take(10)
            ->get();

        return response()->json($news);
    }
}