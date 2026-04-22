@extends('layouts.master')

@section('title', 'News')

@section('content')
<div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrwo">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">News List</li>
        </ol>
    </nav>
    
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">News Articles</h4>

                    <a href="{{ route('news.create') }}" class="btn btn-primary">
                        <i data-lucide="plus"></i> Add News
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
                                <a href="{{ route('news.index', request()->except(['page', 'status'])) }}" 
                                   class="dropdown-item{{ !request('status') ? ' active' : '' }}">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('news.index', ['status' => 'published'] + request()->except(['page', 'status'])) }}" 
                                   class="dropdown-item{{ request('status') == 'published' ? ' active' : '' }}">
                                    <i data-lucide="check-circle" class="icon-sm"></i> Published
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('news.index', ['status' => 'pending'] + request()->except(['page', 'status'])) }}" 
                                   class="dropdown-item{{ request('status') == 'pending' ? ' active' : '' }}">
                                    <i data-lucide="clock" class="icon-sm"></i> Pending
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('news.index', ['status' => 'rejected'] + request()->except(['page', 'status'])) }}" 
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
                            <form method="GET" action="{{ route('news.index') }}" id="dateFilterForm">
                                @if(request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                
                                <!-- Quick Date Options -->
                                <div class="d-flex flex-column gap-1 mb-3">
                                    <a href="{{ route('news.index', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'today'])) }}" 
                                       class="dropdown-item {{ request('date') == 'today' ? 'active' : '' }}">Today</a>
                                    <a href="{{ route('news.index', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'7days'])) }}" 
                                       class="dropdown-item {{ request('date') == '7days' ? 'active' : '' }}">Last 7 Days</a>
                                    <a href="{{ route('news.index', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']), ['date'=>'1month'])) }}" 
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
                                        <a href="{{ route('news.index', array_merge(request()->except(['page', 'date', 'date_from', 'date_to']))) }}" class="btn btn-sm btn-outline-secondary">Reset</a>
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
                           placeholder="Search by title, description, tags..."
                           value="{{ request('search') }}">

                    <button class="btn btn-primary">Search</button>

                    @if(request('search') || request('status') || request('date') || request('date_from') || request('date_to'))
                        <a href="{{ route('news.index') }}" class="btn btn-light">Reset</a>
                    @endif
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>City</th>
                                <th>Media</th>
                                <th>Status</th>
                                <th>Publish Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($news as $item)
                                <tr>
                                    <!-- Index (loop->index) -->
                                    <td>{{ $loop->index + 1 }}</td>
                                    
                                    <!-- Title -->
                                    <td>
                                        <button type="button"
                                                class="btn btn-link p-0 text-start text-decoration-none fw-semibold news-open-modal"
                                                data-bs-toggle="modal"
                                                data-bs-target="#reviewModal{{ $item->id }}">
                                            {{ \Illuminate\Support\Str::limit($item->title, 40) }}
                                        </button>
                                    </td>

                                    <!-- Category -->
                                    <td>{{ $item->category->name ?? 'N/A' }}</td>

                                    <!-- City -->
                                    <td>{{ $item->city ?? '—' }}</td>

                                    <!-- Media -->
                                    <td>
                                        @if($item->media_path)
                                            @if(Str::endsWith($item->media_path, '.mp4'))
                                                @if($item->thumbnail_path)
                                                    <img src="{{ asset('storage/' . $item->thumbnail_path) }}"
                                                         width="40" height="40"
                                                         class="rounded object-fit-cover news-open-modal"
                                                         role="button"
                                                         data-bs-toggle="modal"
                                                         data-bs-target="#reviewModal{{ $item->id }}"
                                                         alt="Video thumbnail">
                                                @else
                                                    <span class="badge bg-dark news-open-modal"
                                                          role="button"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#reviewModal{{ $item->id }}">Video</span>
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $item->media_path) }}"
                                                     width="40" height="40"
                                                     class="rounded object-fit-cover news-open-modal"
                                                     role="button"
                                                     data-bs-toggle="modal"
                                                     data-bs-target="#reviewModal{{ $item->id }}"
                                                     alt="Media">
                                            @endif
                                        @else
                                            <span class="text-muted">No Media</span>
                                        @endif
                                    </td>

                                    <!-- Status -->
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

                                    <!-- Publish Date -->
                                    <td>
                                        {{ $item->formatted_publish_at ?? ($item->publish_at ? $item->publish_at->format('d M Y') : '—') }}
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                Actions
                                            </button>

                                            <div class="dropdown-menu">
                                                <!-- View -->
                                                <button type="button" class="dropdown-item" 
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#reviewModal{{ $item->id }}">
                                                    <i data-lucide="eye"></i> View
                                                </button>

                                                @if($item->status === 'rejected' && $item->rejection_reason)
                                                    <button type="button" class="dropdown-item text-danger" 
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#reasonModal{{ $item->id }}">
                                                        <i data-lucide="alert-circle"></i> View Reason
                                                    </button>
                                                @endif

                                                <!-- Edit -->
                                                <a href="{{ route('news.edit', $item->id) }}" class="dropdown-item">
                                                    <i data-lucide="edit"></i> Edit
                                                </a>

                                                <!-- Delete -->
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('news.destroy', $item->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this news?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i data-lucide="trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Improved View Modal -->
                                <div class="modal fade" id="reviewModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
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

                                                <!-- Media -->
                                                @if($item->media_path)
                                                    <div class="news-preview-media rounded-3 overflow-hidden bg-light border mb-4" style="display: flex; align-items: center; justify-content: center;">
                                                        @if(Str::endsWith($item->media_path, '.mp4') || Str::endsWith($item->media_path, '.mov') || Str::endsWith($item->media_path, '.avi'))
                                                            <video src="{{ asset('storage/'.$item->media_path) }}"
                                                                   controls
                                                                   playsinline
                                                                   preload="metadata"
                                                                   class="news-preview-video"></video>
                                                        @else
                                                            <img src="{{ asset('storage/'.$item->media_path) }}"
                                                                 class="news-preview-image"
                                                                 alt="Media preview">
                                                        @endif
                                                    </div>
                                                @endif

                                                <!-- Title -->
                                                <h4 class="fw-semibold mb-3" style="line-height:1.4;">
                                                    {{ $item->title }}
                                                </h4>

                                                <!-- Meta badges -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                        <i class="bi bi-folder2 me-1"></i>
                                                        {{ $item->category->name ?? 'N/A' }}
                                                    </span>
                                             
                                                    <span class="badge rounded-pill border text-bg-light fw-normal px-3 py-2">
                                                        <i class="bi bi-calendar3 me-1"></i>
                                                        {{ $item->created_at->format('d M Y') }}
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

                                                <!-- Full Description -->
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

                                <!-- Rejection Reason Modal -->
                                @if($item->status === 'rejected' && $item->rejection_reason)
                                    <div class="modal fade" id="reasonModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 rounded-3">
                                                <div class="modal-header border-bottom bg-danger-light py-3 px-4">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i data-lucide="alert-circle" class="text-danger"></i>
                                                        <h5 class="modal-title fw-semibold mb-0">Rejection Reason</h5>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-4">
                                                    <p class="text-muted mb-3 small">This news article was rejected with the following reason:</p>
                                                    <div class="alert alert-danger-light border border-danger-subtle rounded-2 p-3">
                                                        <p class="mb-0" style="color:#721c24;">{{ $item->rejection_reason }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top px-4 py-3">
                                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- Rejection Reason Modal End -->

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
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
                <div class="mt-3">
                    @if($news->hasPages())
                    <div class="mt-3 w-100">
                    {{ $news->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-group .btn,
    .dropdown .btn {
        border-radius: 6px;
        margin-right: 5px;
        padding: 6px 14px;
        font-size: 13px;
    }
    
    .btn-group .btn i,
    .dropdown .btn i {
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

    .news-open-modal { cursor: pointer; }

    /* Bigger centered media preview inside modal */
    .news-preview-media {
        width: 100%;
        height: min(70vh, 520px)!important;
        display: flex;
        align-items: center!important;
        justify-content: center!important;
        background: #000!important;
    }

    .news-preview-video,
    .news-preview-image {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }
    
    .badge.rounded-pill {
        border-radius: 50px !important;
    }
    
    /* Dropdown menu styling */
    .dropdown-item.active {
        background-color: #e9ecef;
        color: #0d6efd;
    }
</style>
@endpush