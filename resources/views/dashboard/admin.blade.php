@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')

    <h4 class="mb-4">Admin Dashboard</h4>

   

    <!-- Stats Cards Row -->
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
                                    <a type="button" id="dropdownMenuButtonTotal" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="more-horizontal" class="lucide lucide-more-horizontal icon-lg text-secondary pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonTotal">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('news.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="eye" class="lucide lucide-eye icon-sm me-2">
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
                                    <a type="button" id="dropdownMenuButtonPublished" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="more-horizontal" class="lucide lucide-more-horizontal icon-lg text-secondary pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPublished">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('news.index', ['status' => 'published']) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="eye" class="lucide lucide-eye icon-sm me-2">
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
                                    <a type="button" id="dropdownMenuButtonPending" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="more-horizontal" class="lucide lucide-more-horizontal icon-lg text-secondary pb-3px">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPending">
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('news.index', ['status' => 'pending']) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="eye" class="lucide lucide-eye icon-sm me-2">
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

    <!-- Recent News Table -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">Recent News</h5>
                <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>
                    Create News
                </a>
            </div>  

            <!-- Status Filter Dropdown and Date Filter Dropdown (Side by Side) -->
            <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
                <!-- Status Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @php
                            $statusLabel = 'All Statuses';
                            if(request('status') == 'published') $statusLabel = 'Published';
                            elseif(request('status') == 'pending') $statusLabel = 'Pending';
                            elseif(request('status') == 'rejected') $statusLabel = 'Rejected';
                        @endphp
                        <i data-lucide="filter" class="icon-sm me-1"></i>
                        {{ $statusLabel }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                        <li>
                            <a href="{{ route('dashboard.admin', request()->except(['page', 'status'])) }}" 
                               class="dropdown-item{{ !request('status') ? ' active' : '' }}">
                                All
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.admin', ['status' => 'published'] + request()->except(['page', 'status'])) }}" 
                               class="dropdown-item{{ request('status') == 'published' ? ' active' : '' }}">
                                <i data-lucide="check-circle" class="icon-sm"></i> Published
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.admin', ['status' => 'pending'] + request()->except(['page', 'status'])) }}" 
                               class="dropdown-item{{ request('status') == 'pending' ? ' active' : '' }}">
                                <i data-lucide="clock" class="icon-sm"></i> Pending
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.admin', ['status' => 'rejected'] + request()->except(['page', 'status'])) }}" 
                               class="dropdown-item{{ request('status') == 'rejected' ? ' active' : '' }}">
                                <i data-lucide="x-circle" class="icon-sm"></i> Rejected
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Date Filter Dropdown (Separate) -->
                <div class="dropdown d-inline-block">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <form method="GET" action="{{ route('dashboard.admin') }}" id="dateFilterForm">
                            @if(request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            
                            <!-- Quick Date Options -->
                            <div class="d-flex flex-column gap-1 mb-3">
                                <a href="{{ route('dashboard.admin', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'today'])) }}" 
                                   class="dropdown-item {{ request('date') == 'today' ? 'active' : '' }}">Today</a>
                                <a href="{{ route('dashboard.admin', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'7days'])) }}" 
                                   class="dropdown-item {{ request('date') == '7days' ? 'active' : '' }}">Last 7 Days</a>
                                <a href="{{ route('dashboard.admin', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'1month'])) }}" 
                                   class="dropdown-item {{ request('date') == '1month' ? 'active' : '' }}">Last 1 Month</a>
                            </div>
                            
                            <div class="dropdown-divider my-2"></div>
                            
                            <!-- Custom Date Range -->
                            <div class="mb-2">
                                <label for="date_from" class="form-label small">Date From</label>
                                <input type="datetime-local" class="form-control form-control-sm" id="date_from" name="date_from" value="{{ request('date_from') }}">
                            </div>
                            <div class="mb-3">
                                <label for="date_to" class="form-label small">Date To</label>
                                <input type="datetime-local" class="form-control form-control-sm" id="date_to" name="date_to" value="{{ request('date_to') }}">
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-sm btn-primary w-100">Apply Range</button>
                                @if(request('date_from') || request('date_to') || request('date'))
                                    <a href="{{ route('dashboard.admin', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']))) }}" class="btn btn-sm btn-outline-secondary">Reset</a>
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
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-light">Reset</a>
                @endif
            </form>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentNews as $news)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="fw-medium">{{ \Illuminate\Support\Str::limit($news->title, 50) }}</td>
                            <td>{{ $news->category->name ?? 'N/A' }}</td>
                            <td>{{ $news->author->name ?? 'N/A' }}</td>
                            <td>
                                @if($news->status == 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($news->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $news->formatted_publish_at ?? ($news->publish_at ? $news->publish_at->format('d M Y H:i') : '—') }}</td>
                       
                       
                       
                            <td>
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#reviewModal{{ $news->id }}">
                                    Review
                                </button>
                            </td>
                        </tr>

                        <!-- MODAL -->
                        <div class="modal fade" id="reviewModal{{ $news->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 overflow-hidden">

                                    <!-- Header -->
                                    <div class="modal-header border-bottom py-3 px-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="rounded-circle d-inline-block
                                                @if($news->status == 'published') bg-success
                                                @elseif($news->status == 'pending') bg-warning
                                                @else bg-danger @endif"
                                                style="width:8px;height:8px;">
                                            </span>
                                            <span class="text-uppercase text-muted fw-semibold"
                                                style="font-size:11px;letter-spacing:.06em;">
                                                {{ ucfirst($news->status) }}
                                            </span>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body p-4">

                                        <!-- Title -->
                                        <h4 class="fw-semibold mb-3" style="line-height:1.4;">
                                            {{ $news->title }}
                                        </h4>

                                        <!-- Media -->
                                        @if($news->media_path)
                                            <div class="rounded-3 overflow-hidden bg-light border mb-4"
                                                style="height:320px;">
                                                @if(Str::endsWith($news->media_path, '.mp4') || Str::endsWith($news->media_path, '.mov') || Str::endsWith($news->media_path, '.avi'))
                                                    <video src="{{ asset('storage/'.$news->media_path) }}"
                                                        controls class="w-100" style="max-height:320px;"></video>
                                                @else
                                                    <img src="{{ asset('storage/'.$news->media_path) }}"
                                                        class="w-100 object-fit-cover" style="max-height:320px;">
                                                @endif
                                            </div>
                                        @endif

                                        <!-- Meta badges -->
                                        <div class="d-flex flex-wrap gap-2 mb-4">
                                            <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                <i class="bi bi-folder2 me-1"></i>
                                                {{ $news->category->name ?? 'N/A' }}
                                            </span>
                                        
                                            <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $news->formatted_publish_at ?? ($news->publish_at ? $news->publish_at->format('d M Y') : '—') }}
                                            </span>
                                            @if($news->city)
                                                <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                    <i class="bi bi-geo-alt me-1"></i>
                                                    {{ $news->city }}
                                                </span>
                                            @endif
                                            @if($news->is_important)
                                                <span class="badge rounded-pill bg-danger fw-normal px-3 py-2">
                                                    <i class="bi bi-star-fill me-1"></i>
                                                    Important
                                                </span>
                                            @endif
                                        </div>

                                        <hr class="my-3">

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <p class="text-uppercase text-muted fw-semibold mb-1"
                                                style="font-size:11px;letter-spacing:.05em;">
                                                Short Description
                                            </p>
                                            <p class="mb-0" style="color:#6c757d;">{{ $news->short_description }}</p>
                                        </div>

                                        <!-- Rejection Reason -->
                                        @if($news->status === 'rejected' && $news->rejection_reason)
                                            <div class="mb-3">
                                                <p class="text-uppercase text-muted fw-semibold mb-1"
                                                    style="font-size:11px;letter-spacing:.05em;">
                                                    Rejection Reason
                                                </p>
                                                <div class="alert alert-danger-light border border-danger-subtle rounded-2 p-2">
                                                    <p class="mb-0" style="color:#721c24;font-size:14px;">{{ $news->rejection_reason }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Source Link -->
                                        @if($news->source_link)
                                            <div class="mb-3">
                                                <p class="text-uppercase text-muted fw-semibold mb-1"
                                                    style="font-size:11px;letter-spacing:.05em;">
                                                    Source Link
                                                </p>
                                                <a href="{{ $news->source_link }}"
                                                   target="_blank" rel="noopener noreferrer"
                                                   class="text-primary text-decoration-underline">
                                                    {{ $news->source_link }}
                                                </a>
                                            </div>
                                        @endif

                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer border-top px-4 py-3">
                                        @if($news->status == 'pending')
                                            <button type="button" class="btn btn-outline-danger px-4" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $news->id }}" data-bs-dismiss="modal">
                                                Reject
                                            </button>

                                            <form action="{{ route('news.updateStatus', $news->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="published">
                                                <button type="submit" class="btn btn-success px-5">Approve & Go Live</button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- REJECTION MODAL -->
                        <div class="modal fade" id="rejectModal{{ $news->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-3">
                                    <div class="modal-header border-bottom bg-light py-3 px-4">
                                        <h5 class="modal-title fw-semibold">Reject News Article</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body px-4 py-4">
                                        <form action="{{ route('news.updateStatus', $news->id) }}" method="POST" id="rejectForm{{ $news->id }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            
                                            <p class="text-muted mb-3">Are you sure you want to reject this news article? You can optionally provide a reason for rejection.</p>
                                            
                                            <div class="mb-3">
                                                <label for="rejection_reason{{ $news->id }}" class="form-label">Rejection Reason <span class="text-muted">(Optional)</span></label>
                                                <textarea 
                                                    class="form-control form-control-sm" 
                                                    id="rejection_reason{{ $news->id }}" 
                                                    name="rejection_reason"
                                                    rows="3"
                                                    placeholder="Enter reason for rejection..."
                                                    maxlength="500"></textarea>
                                                <small class="text-muted d-block mt-1">Max 500 characters</small>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-top px-4 py-3">
                                        <button type="button" class="btn btn-light px-3" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" form="rejectForm{{ $news->id }}" class="btn btn-danger px-4">
                                            <i class="bi bi-x-circle me-1"></i> Reject Article
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- REJECTION MODAL END -->

                        <!-- MODAL END -->


                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No news found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
 

@endsection

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