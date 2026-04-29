<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    private function toNewsResponseItem(News $item, string $lang = 'en'): array
    {
        $ext = strtolower(pathinfo((string) $item->media_path, PATHINFO_EXTENSION));
        $mime = match ($ext) {
            'webm' => 'video/webm',
            'ogg' => 'video/ogg',
            default => 'video/mp4',
        };

        $lang = strtolower((string) $lang);
        $lang = in_array($lang, ['en', 'hi']) ? $lang : 'en';

        if ($lang === 'hi') {
            $title = (string) ($item->title_hi ?: ($item->title ?: ($item->title_en ?: '')));
            $shortSummary = (string) ($item->short_description_hi ?: ($item->short_description ?: ($item->short_description_en ?: '')));
        } else {
            $title = (string) ($item->title_en ?: ($item->title ?: ($item->title_hi ?: '')));
            $shortSummary = (string) ($item->short_description_en ?: ($item->short_description ?: ($item->short_description_hi ?: '')));
        }

        return [
            'id' => $item->id,
            'title' => $title,
            'shortSummary' => $shortSummary,
            'imageUrl' => $item->media_type === 'video'
                ? ($item->thumbnail_path ? asset('storage/' . $item->thumbnail_path) : null)
                : ($item->media_path ? asset('storage/' . $item->media_path) : null),
            'videoUrl' => $item->media_type === 'video' && $item->media_path
                ? asset('storage/' . $item->media_path)
                : null,
            'videoMime' => $item->media_type === 'video' ? $mime : null,
            'url' => $item->source_link,
            'source' => optional($item->author)->name ?? 'Admin',
            'publishedAt' => $item->publish_at,
            'category' => optional($item->category)->slug,
            'tags' => $item->tags,
            'cityId' => $item->city_id,
            'stateId' => $item->state_id,
        ];
    }

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
        $lang = strtolower((string) $request->get('lang', 'en'));
        $lang = in_array($lang, ['en', 'hi']) ? $lang : 'en';

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
            'data' => collect($paginator->items())->map(function ($item) use ($lang) {
                return $this->toNewsResponseItem($item, $lang) + ['readTime' => '2 min'];
            }),
            'meta' => [
                'page' => $paginator->currentPage(),
                'limit' => $paginator->perPage(),
                'total' => $paginator->total(),
                'lastPage' => $paginator->lastPage(),
            ],
        ]);
    }

    public function show(Request $request, int $id)
    {
        $lang = strtolower((string) $request->get('lang', 'en'));
        $lang = in_array($lang, ['en', 'hi']) ? $lang : 'en';

        $news = News::with(['category', 'author'])
            ->where('status', 'published')
            ->find($id);

        if (! $news) {
            return response()->json([
                'success' => false,
                'message' => 'News not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->toNewsResponseItem($news, $lang),
        ]);
    }



    public function search(Request $request)
    {
        $lang = strtolower((string) $request->get('lang', 'en'));
        $lang = in_array($lang, ['en', 'hi']) ? $lang : 'en';

        $query = $request->q;
    
        $builder = News::with(['category', 'city', 'state'])
            ->when($query, function ($q) use ($query) {
                $q->where(function ($qq) use ($query) {
                    $qq->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('title_en', 'LIKE', "%{$query}%")
                        ->orWhere('title_hi', 'LIKE', "%{$query}%")
                        ->orWhere('short_description', 'LIKE', "%{$query}%")
                        ->orWhere('short_description_en', 'LIKE', "%{$query}%")
                        ->orWhere('short_description_hi', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('category', function ($cat) use ($query) {
                    $cat->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('slug', 'LIKE', "%{$query}%");
                })
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
            'data' => collect($paginator->items())->map(function ($item) use ($lang) {
                return $this->toNewsResponseItem($item, $lang);
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