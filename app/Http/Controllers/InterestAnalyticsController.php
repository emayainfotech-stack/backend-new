<?php

namespace App\Http\Controllers;

use App\Models\NewsClick;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InterestAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $from = null;
        $to = null;

        if ($request->filled('date')) {
            $now = Carbon::now();
            if ($request->date === 'today') {
                $from = $now->copy()->startOfDay();
                $to = $now->copy()->endOfDay();
            } elseif ($request->date === '7days') {
                $from = $now->copy()->subDays(7);
                $to = $now;
            } elseif ($request->date === '1month') {
                $from = $now->copy()->subMonth();
                $to = $now;
            }
        }

        if ($request->filled('date_from')) {
            $from = Carbon::parse($request->date_from);
        }
        if ($request->filled('date_to')) {
            $to = Carbon::parse($request->date_to);
        }

        $base = NewsClick::query();
        if ($from) $base->where('clicked_at', '>=', $from);
        if ($to) $base->where('clicked_at', '<=', $to);

        $totalClicks = (clone $base)->count();
        $uniqueDevices = (clone $base)->distinct('device_id')->count('device_id');

        $topCategories = (clone $base)
            ->leftJoin('categories', 'news_clicks.category_id', '=', 'categories.id')
            ->selectRaw('news_clicks.category_id, COALESCE(categories.name, "Unknown") as category_name, COUNT(*) as clicks')
            ->groupBy('news_clicks.category_id', 'categories.name')
            ->orderByDesc('clicks')
            ->limit(10)
            ->get()
            ->map(function ($row) use ($totalClicks) {
                $row->share = $totalClicks > 0 ? round(($row->clicks / $totalClicks) * 100, 1) : 0;
                return $row;
            });

        $topNews = (clone $base)
            ->leftJoin('news', 'news_clicks.news_id', '=', 'news.id')
            ->leftJoin('categories', 'news.category_id', '=', 'categories.id')
            ->selectRaw('news_clicks.news_id, COALESCE(news.title, "Deleted news") as title, COALESCE(categories.name, "Unknown") as category_name, COUNT(*) as clicks')
            ->groupBy('news_clicks.news_id', 'news.title', 'categories.name')
            ->orderByDesc('clicks')
            ->limit(10)
            ->get();

        $deviceLeaders = (clone $base)
            ->selectRaw('device_id, COUNT(*) as clicks, COUNT(DISTINCT news_id) as unique_news')
            ->groupBy('device_id')
            ->orderByDesc('clicks')
            ->limit(10)
            ->get();

        return view('analytics.interest', compact(
            'totalClicks',
            'uniqueDevices',
            'topCategories',
            'topNews',
            'deviceLeaders',
            'from',
            'to'
        ));
    }
}

