<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Redirect based on user role
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role === 'reporter') {
            return redirect()->route('dashboard.reporter');
        }

        return view('dashboard');
    }

    public function admin(Request $request)
    {
        $now = Carbon::now();
    
        // News Statistics
        $totalNews = News::count();
        
        $publishedNews = News::where('status', 'published')
            ->where(function ($q) use ($now) {
                $q->whereNull('publish_at')->orWhere('publish_at', '<=', $now);
            })
            ->count();
    
        $pendingNews = News::where('status', 'pending')->count();
        $rejectedNews = News::where('status', 'rejected')->count();
    
        // Base Query for Recent News
        $recentNewsQuery = News::with(['author', 'category']);
    
        // ✅ Quick Date Filters
        if ($request->filled('date')) {
            if ($request->date == 'today') {
                $recentNewsQuery->whereDate('publish_at', Carbon::today());
            }
    
            if ($request->date == '7days') {
                $recentNewsQuery->where('publish_at', '>=', Carbon::now()->subDays(7));
            }
    
            if ($request->date == '1month') {
                $recentNewsQuery->where('publish_at', '>=', Carbon::now()->subMonth());
            }
        }
    
        // ✅ Custom Date Range
        if ($request->filled('date_from')) {
            $recentNewsQuery->where('publish_at', '>=', Carbon::parse($request->date_from));
        }
    
        if ($request->filled('date_to')) {
            $recentNewsQuery->where('publish_at', '<=', Carbon::parse($request->date_to));
        }
    
        // Status filter
        if ($request->has('status') && in_array($request->status, ['published', 'pending', 'rejected'])) {
            $recentNewsQuery->where('status', $request->status);
        }
    
        // 🔍 Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $recentNewsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('short_description', 'like', "%$search%")
                  ->orWhereHas('author', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('category', function ($q3) use ($search) {
                      $q3->where('name', 'like', "%$search%");
                  });
            });
        }
    
        // 🔽 Order + Limit
        $recentNews = $recentNewsQuery
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    
        // Categories Statistics
        $categoriesCount = Category::count();
    
        // Users Statistics
        $usersCount = User::count();
    
        // News by Category
        $newsByCategory = News::join('categories', 'news.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COUNT(*) as count')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('count', 'desc')
            ->take(6)
            ->get();
    
        // Monthly News
        $monthlyNews = News::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $now->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();
    
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = $monthlyNews[$i] ?? 0;
        }
    
        $importantNewsCount = News::where('is_important', true)
            ->where('status', 'published')
            ->count();
    
        return view('dashboard.admin', compact(
            'totalNews',
            'publishedNews',
            'pendingNews',
            'rejectedNews',
            'categoriesCount',
            'usersCount',
            'importantNewsCount',
            'recentNews',
            'newsByCategory',
            'monthlyData'
        ));
    }
    public function reporter(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

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
         

        // 🔍 Search (same as /news)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // 📌 Status filter (default rejected)
        if ($request->filled('status') && in_array($request->status, ['published', 'pending', 'rejected'], true)) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'rejected');
        }

        // 📅 Quick date filter (same params as /news)
        if ($request->filled('date')) {
            $now = Carbon::now();
            if ($request->date === 'today') {
                $query->whereBetween('created_at', [$now->copy()->startOfDay(), $now->copy()->endOfDay()]);
            } elseif ($request->date === '7days') {
                $query->where('created_at', '>=', $now->copy()->subDays(7));
            } elseif ($request->date === '1month') {
                $query->where('created_at', '>=', $now->copy()->subMonth());
            }
        }

        // 📅 Custom date range filter
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', Carbon::parse($request->date_from));
        }
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', Carbon::parse($request->date_to));
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

