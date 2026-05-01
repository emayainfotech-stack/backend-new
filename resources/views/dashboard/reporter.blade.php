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

    <!-- Filters (same style/params as /news) -->
    <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
        <!-- Status Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="statusDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $statusLabel = 'Rejected'; // default on reporter dashboard
                    if(request('status') == 'published') $statusLabel = 'Published';
                    elseif(request('status') == 'pending') $statusLabel = 'Pending';
                    elseif(request('status') == 'rejected') $statusLabel = 'Rejected';
                @endphp
                <i data-lucide="filter" class="icon-sm me-1"></i>
                {{ $statusLabel }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                <li>
                    <a href="{{ route('dashboard.reporter', request()->except(['page', 'status'])) }}"
                       class="dropdown-item{{ !request('status') ? ' active' : '' }}">
                        Rejected (Default)
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.reporter', ['status' => 'published'] + request()->except(['page', 'status'])) }}"
                       class="dropdown-item{{ request('status') == 'published' ? ' active' : '' }}">
                        <i data-lucide="check-circle" class="icon-sm"></i> Published
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.reporter', ['status' => 'pending'] + request()->except(['page', 'status'])) }}"
                       class="dropdown-item{{ request('status') == 'pending' ? ' active' : '' }}">
                        <i data-lucide="clock" class="icon-sm"></i> Pending
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.reporter', ['status' => 'rejected'] + request()->except(['page', 'status'])) }}"
                       class="dropdown-item{{ request('status') == 'rejected' ? ' active' : '' }}">
                        <i data-lucide="x-circle" class="icon-sm"></i> Rejected
                    </a>
                </li>
            </ul>
        </div>

        <!-- Date Filter Dropdown -->
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i data-lucide="calendar" class="icon-sm me-1"></i>
                @php
                    $dateLabel = 'Date';
                    if(request('date') == 'today') $dateLabel = 'Today';
                    elseif(request('date') == '7days') $dateLabel = 'Last 7 Days';
                    elseif(request('date') == '1month') $dateLabel = 'Last 1 Month';
                    elseif(request('date_from') || request('date_to')) $dateLabel = 'Custom Range';
                @endphp
                {{ $dateLabel }}
            </button>
            <div class="dropdown-menu p-3" style="min-width: 260px;">
                <form method="GET" action="{{ route('dashboard.reporter') }}" id="dateFilterForm">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <!-- Quick Date Options -->
                    <div class="d-flex flex-column gap-1 mb-3">
                        <a href="{{ route('dashboard.reporter', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'today'])) }}"
                           class="dropdown-item {{ request('date') == 'today' ? 'active' : '' }}">Today</a>
                        <a href="{{ route('dashboard.reporter', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'7days'])) }}"
                           class="dropdown-item {{ request('date') == '7days' ? 'active' : '' }}">Last 7 Days</a>
                        <a href="{{ route('dashboard.reporter', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'1month'])) }}"
                           class="dropdown-item {{ request('date') == '1month' ? 'active' : '' }}">Last 1 Month</a>
                    </div>

                    <div class="dropdown-divider my-2"></div>

                    <!-- Custom Date Range -->
                    <div class="mb-2">
                        <label for="date_from" class="form-label small">Date From</label>
                        <input type="datetime-local" class="form-control form-control-sm" id="date_from"
                               name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="mb-3">
                        <label for="date_to" class="form-label small">Date To</label>
                        <input type="datetime-local" class="form-control form-control-sm" id="date_to"
                               name="date_to" value="{{ request('date_to') }}">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary w-100">Apply Range</button>
                        @if(request('date_from') || request('date_to') || request('date'))
                            <a href="{{ route('dashboard.reporter', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']))) }}"
                               class="btn btn-sm btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 🔍 Search Form -->
    <form method="GET" class="mb-3 d-flex gap-2">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        @if(request('date'))
            <input type="hidden" name="date" value="{{ request('date') }}">
        @endif
        @if(request('date_from'))
            <input type="hidden" name="date_from" value="{{ request('date_from') }}">
        @endif
        @if(request('date_to'))
            <input type="hidden" name="date_to" value="{{ request('date_to') }}">
        @endif

        <input type="text" name="search" class="form-control"
               placeholder="Search by title, description..."
               value="{{ request('search') }}">

        <button class="btn btn-primary">Search</button>

        @if(request('search') || request('status') || request('date') || request('date_from') || request('date_to'))
            <a href="{{ route('dashboard.reporter') }}" class="btn btn-light">Reset</a>
        @endif
    </form>

    <!-- My News Table -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <h5 class="card-title mb-4">
                @php
                    $titleStatus = request('status') ?: 'rejected';
                @endphp
                {{ ucfirst($titleStatus) }} News
            </h5>
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

                                            <!-- Source Link -->
                                            @if($item->source_link)
                                                <div class="mb-3">
                                                    <p class="text-uppercase text-muted fw-semibold mb-1"
                                                        style="font-size:11px;letter-spacing:.05em;">
                                                        Source Link
                                                    </p>
                                                    <a href="{{ $item->source_link }}"
                                                       target="_blank" rel="noopener noreferrer"
                                                       class="text-primary text-decoration-underline">
                                                        {{ $item->source_link }}
                                                    </a>
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
            data: <?= json_encode([(int) $totalNews, (int) $publishedNews, (int) $pendingNews]) ?>
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
            data: <?= json_encode([(int) $publishedNews, (int) (($publishedNews ?? 0) > 0 ? $publishedNews - 2 : 0), (int) $publishedNews]) ?>
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
            data: <?= json_encode([(int) $pendingNews, (int) (($pendingNews ?? 0) > 0 ? $pendingNews - 1 : 0), (int) $pendingNews]) ?>
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