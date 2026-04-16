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
                            <td>{{ $news->formatted_publish_at ?? ($news->publish_at ? $news->publish_at->format('d M Y') : '—') }}</td>
                       
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
                                                style="max-height:240px;">
                                                @if(Str::endsWith($news->media_path, '.mp4') || Str::endsWith($news->media_path, '.mov') || Str::endsWith($news->media_path, '.avi'))
                                                    <video src="{{ asset('storage/'.$news->media_path) }}"
                                                        controls class="w-100"></video>
                                                @else
                                                    <img src="{{ asset('storage/'.$news->media_path) }}"
                                                        class="w-100 object-fit-cover">
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

                                      

                                        <!-- Tags -->
                                        @if($news->tags)
                                            <div>
                                                <p class="text-uppercase text-muted fw-semibold mb-2"
                                                    style="font-size:11px;letter-spacing:.05em;">
                                                    Tags
                                                </p>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach(is_array($news->tags) ? $news->tags : json_decode($news->tags, true) ?? [] as $tag)
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
                                        @if($news->status == 'pending')
                                            <form action="{{ route('news.updateStatus', $news->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-outline-danger px-4">Reject</button>
                                            </form>

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