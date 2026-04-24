<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsClick;
use Illuminate\Http\Request;

class NewsTrackController extends Controller
{
    /**
     * Track a click/open event from the mobile app.
     *
     * POST /api/news/{news}/track
     * Body: { device_id: "..." }
     */
    public function track(Request $request, News $news)
    {
        $data = $request->validate([
            'device_id' => ['required', 'string', 'max:128'],
        ]);

        NewsClick::create([
            'news_id' => $news->id,
            'device_id' => $data['device_id'],
            'category_id' => $news->category_id,
            'clicked_at' => now(),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}

