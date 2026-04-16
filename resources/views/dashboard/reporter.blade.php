@extends('layouts.master')

@section('title', 'Reporter Dashboard')

@section('content')

 
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Reporter Dashboard</h4>
        <a href="{{ route('news.create') }}" class="btn btn-primary">
            <i data-lucide="plus"></i> Add News
        </a>
    </div>

    <!-- Stats Cards Row (Same as Admin) -->
    <div class="row mb-4">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <!-- Total News Card -->
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total News</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" class="dropdown-toggle-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-lg text-secondary pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('news.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-sm me-2">
                                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <span class="">View All</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $totalNews }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-info">
                                            <span>Total Articles</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="totalNewsChart" class="mt-md-3 mt-xl-0" style="min-height: 60px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Published News Card -->
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Published News</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" class="dropdown-toggle-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-lg text-secondary pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('news.index', ['status' => 'published']) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-sm me-2">
                                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <span class="">View Published</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $publishedNews }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Live Now</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="publishedChart" class="mt-md-3 mt-xl-0" style="min-height: 60px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending News Card -->
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Pending Review</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" class="dropdown-toggle-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-lg text-secondary pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('news.index', ['status' => 'pending']) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-sm me-2">
                                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <span class="">View Pending</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $pendingNews }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-warning">
                                            <span>Awaiting Approval</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="pendingChart" class="mt-md-3 mt-xl-0" style="min-height: 60px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="col-md-6">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search by title..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
                @if(request('search') || request('status'))
                    <div class="col-md-12">
                        <a href="{{ route('reporter.dashboard') }}" class="btn btn-light btn-sm">Reset Filters</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- My News Table -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <h5 class="card-title mb-4">My News</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Publish Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>
                                    <strong>{{ \Illuminate\Support\Str::limit($item->title, 50) }}</strong>
                                </td>
                                <td>{{ $item->category->name ?? 'N/A' }}</td>
                                <td>{{ $item->city ?? '—' }}</td>
                                <td>
                                    @php $status = $item->status; @endphp
                                    <span class="badge 
                                        {{ $status == 'published' ? 'bg-success-subtle text-success' : 
                                           ($status == 'pending' ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') }}">
                                        <i data-lucide="{{ $status == 'published' ? 'check-circle' : ($status == 'pending' ? 'clock' : 'x-circle') }}" 
                                           class="icon-sm me-1"></i>
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $item->formatted_publish_at ?? ($item->publish_at ? $item->publish_at->format('d M Y') : '—') }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-sm btn-outline-info" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $item->id }}">
                                            <i data-lucide="eye" class="w-16px h-16px"></i>
                                        </button>
                                        
                                        <!-- Edit Button -->
                                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i data-lucide="edit" class="w-16px h-16px"></i>
                                        </a>
                                        
                                        <!-- Delete Button -->
                                        <form action="{{ route('news.destroy', $item->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this news?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i data-lucide="trash" class="w-16px h-16px"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                                    <div class="modal-content border-0 rounded-4 overflow-hidden">

                                        <!-- Header -->
                                        <div class="modal-header border-bottom py-3 px-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="rounded-circle d-inline-block
                                                    @if($item->status == 'published') bg-success
                                                    @elseif($item->status == 'pending') bg-warning
                                                    @else bg-danger @endif"
                                                    style="width:8px;height:8px;">
                                                </span>
                                                <span class="text-uppercase text-muted fw-semibold"
                                                    style="font-size:11px;letter-spacing:.06em;">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Body -->
                                        <div class="modal-body p-4">

                                            <!-- Title -->
                                            <h4 class="fw-semibold mb-3" style="line-height:1.4;">
                                                {{ $item->title }}
                                            </h4>

                                            <!-- Media -->
                                            @if($item->media_path)
                                                <div class="rounded-3 overflow-hidden bg-light border mb-4"
                                                    style="max-height:240px;">
                                                    @if(Str::endsWith($item->media_path, '.mp4') || Str::endsWith($item->media_path, '.mov') || Str::endsWith($item->media_path, '.avi'))
                                                        <video src="{{ asset('storage/'.$item->media_path) }}"
                                                            controls class="w-100"></video>
                                                    @else
                                                        <img src="{{ asset('storage/'.$item->media_path) }}"
                                                            class="w-100 object-fit-cover">
                                                    @endif
                                                </div>
                                            @endif

                                            <!-- Meta badges -->
                                            <div class="d-flex flex-wrap gap-2 mb-4">
                                                <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                    <i class="bi bi-folder2 me-1"></i>
                                                    {{ $item->category->name ?? 'N/A' }}
                                                </span>
                                        
                                                <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ $item->created_at->format('d M Y') ?? ($item->publish_at ? $item->publish_at->format('d M Y') : '—') }}
                                                </span>
                                                @if($item->city)
                                                    <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                        <i class="bi bi-geo-alt me-1"></i>
                                                        {{ $item->city }}
                                                    </span>
                                                @endif
                                                @if($item->is_important)
                                                    <span class="badge rounded-pill bg-danger fw-normal px-3 py-2">
                                                        <i class="bi bi-star-fill me-1"></i>
                                                        Important
                                                    </span>
                                                @endif
                                            </div>

                                            <hr class="my-3">

                                            <!-- Short Description -->
                                            <div class="mb-3">
                                                <p class="text-uppercase text-muted fw-semibold mb-1"
                                                    style="font-size:11px;letter-spacing:.05em;">
                                                    Short Description
                                                </p>
                                                <p class="mb-0" style="color:#6c757d;">{{ $item->short_description }}</p>
                                            </div>

                                            @if($item->full_description)
                                                <div class="mb-3">
                                                    <p class="text-uppercase text-muted fw-semibold mb-1"
                                                        style="font-size:11px;letter-spacing:.05em;">
                                                        Full Description
                                                    </p>
                                                    <p class="mb-0" style="color:#6c757d;">{{ $item->full_description }}</p>
                                                </div>
                                            @endif

                                            <!-- Tags -->
                                            @if($item->tags)
                                                <div>
                                                    <p class="text-uppercase text-muted fw-semibold mb-2"
                                                        style="font-size:11px;letter-spacing:.05em;">
                                                        Tags
                                                    </p>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach(is_array($item->tags) ? $item->tags : json_decode($item->tags, true) ?? [] as $tag)
                                                            <span class="badge rounded-pill px-3 py-2"
                                                                style="background:#EEEDFE;color:#3C3489;border:0.5px solid #AFA9EC;font-weight:400;">
                                                                #{{ $tag }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer border-top px-4 py-3">
                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    @if(request('status'))
                                        No {{ request('status') }} news found
                                    @else
                                        No news found
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
                <div class="mt-4">
                    {{ $news->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>


@endsection

@push('styles')
<style>
    .dropdown-toggle-icon {
        text-decoration: none;
        background: transparent;
        border: none;
    }
    
    .dropdown-toggle-icon:hover {
        opacity: 0.8;
    }
    
    .btn-group .btn {
        border-radius: 6px;
        margin-right: 5px;
        padding: 6px 14px;
        font-size: 13px;
    }
    
    .btn-group .btn i {
        width: 14px;
        height: 14px;
        margin-right: 4px;
    }
    
    .bg-success-subtle {
        background-color: #d4edda !important;
    }
    
    .bg-warning-subtle {
        background-color: #fff3cd !important;
    }
    
    .bg-danger-subtle {
        background-color: #f8d7da !important;
    }
    
    .badge i {
        width: 12px;
        height: 12px;
        vertical-align: middle;
    }
    
    /* Modal styling */
    .modal-content {
        border-radius: 16px !important;
    }
    
    .modal-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }
    
    .rounded-4 {
        border-radius: 16px;
    }
    
    .object-fit-cover {
        object-fit: cover;
        max-height: 240px;
    }
    
    .badge.rounded-pill {
        border-radius: 50px !important;
    }
    
    /* Dropdown menu styling */
    .dropdown-menu {
        min-width: 160px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-radius: 8px;
        border: none;
    }
    
    .dropdown-item {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    
    .dropdown-item svg {
        width: 16px;
        height: 16px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Total News Chart
    var totalOptions = {
        series: [{
            name: 'News',
            data: [{{ $totalNews }}, {{ $publishedNews }}, {{ $pendingNews }}]
        }],
        chart: {
            height: 60,
            type: 'area',
            sparkline: { enabled: true },
            toolbar: { show: false }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        fill: { opacity: 0.3, type: 'solid' },
        colors: ['#4a6cf7'],
        tooltip: { enabled: false },
        grid: { show: false },
        xaxis: { labels: { show: false } },
        yaxis: { labels: { show: false } }
    };
    
    var totalChart = new ApexCharts(document.querySelector("#totalNewsChart"), totalOptions);
    totalChart.render();

    // Published Chart
    var publishedOptions = {
        series: [{
            name: 'Published',
            data: [{{ $publishedNews }}, {{ $publishedNews > 0 ? $publishedNews - 2 : 0 }}, {{ $publishedNews }}]
        }],
        chart: {
            height: 60,
            type: 'line',
            sparkline: { enabled: true },
            toolbar: { show: false }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        colors: ['#28a745'],
        tooltip: { enabled: false },
        grid: { show: false },
        xaxis: { labels: { show: false } },
        yaxis: { labels: { show: false } }
    };
    
    var publishedChart = new ApexCharts(document.querySelector("#publishedChart"), publishedOptions);
    publishedChart.render();

    // Pending Chart
    var pendingOptions = {
        series: [{
            name: 'Pending',
            data: [{{ $pendingNews }}, {{ $pendingNews > 0 ? $pendingNews - 1 : 0 }}, {{ $pendingNews }}]
        }],
        chart: {
            height: 60,
            type: 'bar',
            sparkline: { enabled: true },
            toolbar: { show: false }
        },
        plotOptions: {
            bar: { columnWidth: '60%', borderRadius: 4 }
        },
        dataLabels: { enabled: false },
        colors: ['#ffc107'],
        tooltip: { enabled: false },
        grid: { show: false },
        xaxis: { labels: { show: false } },
        yaxis: { labels: { show: false } }
    };
    
    var pendingChart = new ApexCharts(document.querySelector("#pendingChart"), pendingOptions);
    pendingChart.render();
</script>
@endpush