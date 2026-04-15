<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Redirect based on user role
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role === 'reporter') {
            return redirect()->route('dashboard.reporter');
        }

        return view('dashboard');
    }

public function admin()
{
    $now = Carbon::now();

    // News Statistics
    $totalNews = News::count();
    
    $publishedNews = News::query()
        ->where('status', 'published')
        ->where(function ($q) use ($now) {
            $q->whereNull('publish_at')->orWhere('publish_at', '<=', $now);
        })
        ->count();

    $pendingNews = News::query()
        ->where('status', 'pending')
        ->count();

    $rejectedNews = News::query()
        ->where('status', 'rejected')
        ->count();

    // Categories Statistics
    $categoriesCount = Category::count();

    // Users Statistics
    $usersCount = User::count();

    // Recent News for Dashboard Table (show all recent news, not just pending)
    $recentNews = News::with(['author', 'category'])
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    // News by Category for Chart
    $newsByCategory = News::join('categories', 'news.category_id', '=', 'categories.id')
        ->selectRaw('categories.name, COUNT(*) as count')
        ->groupBy('categories.id', 'categories.name')
        ->orderBy('count', 'desc')
        ->take(6)
        ->get();

    // Monthly News Statistics for Chart
    $monthlyNews = News::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $now->year)
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')
        ->toArray();

    // Fill missing months with 0
    $monthlyData = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthlyData[$i] = $monthlyNews[$i] ?? 0;
    }

    // Important News Count
    $importantNewsCount = News::where('is_important', true)
        ->where('status', 'published')
        ->count();

    return view('dashboard.admin', [
        'totalNews' => $totalNews,
        'publishedNews' => $publishedNews,
        'pendingNews' => $pendingNews,
        'rejectedNews' => $rejectedNews,
        'categoriesCount' => $categoriesCount,
        'usersCount' => $usersCount,
        'importantNewsCount' => $importantNewsCount,
        'recentNews' => $recentNews,
        'newsByCategory' => $newsByCategory,
        'monthlyData' => $monthlyData,
    ]);
}

    public function reporter(Request $request)
    {
        $user = auth()->user();

        // Reporter-specific statistics
        $totalNews = News::count();
        $pendingNews = News:: where('status', 'pending')
            ->count();
        $publishedNews = News::
            where('status', 'published')
            ->count();
        $rejectedNews = News::
        where('status', 'rejected')
            ->count();

        // Query builder for news with search and filter
        $query = News::with('category');
         

        // Search by title
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Paginate results
        $news = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.reporter', [
            'totalNews' => $totalNews,
            'pendingNews' => $pendingNews,
            'publishedNews' => $publishedNews,
            'rejectedNews' => $rejectedNews,
            'news' => $news,
        ]);
    }
}

