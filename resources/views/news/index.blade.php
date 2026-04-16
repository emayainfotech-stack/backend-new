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

                <!-- Status Filter Buttons -->
                <div class="mb-3">
                    <div class="btn-group" role="group">
                        <a href="{{ route('news.index') }}" 
                           class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-secondary' }}">
                            All
                        </a>
                        <a href="{{ route('news.index', ['status' => 'published']) }}" 
                           class="btn btn-sm {{ request('status') == 'published' ? 'btn-success' : 'btn-outline-secondary' }}">
                            <i data-lucide="check-circle" class="icon-sm"></i> Published
                        </a>
                        <a href="{{ route('news.index', ['status' => 'pending']) }}" 
                           class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-secondary' }}">
                            <i data-lucide="clock" class="icon-sm"></i> Pending
                        </a>
                        <a href="{{ route('news.index', ['status' => 'rejected']) }}" 
                           class="btn btn-sm {{ request('status') == 'rejected' ? 'btn-danger' : 'btn-outline-secondary' }}">
                            <i data-lucide="x-circle" class="icon-sm"></i> Rejected
                        </a>
                    </div>
                </div>

                <!-- 🔍 Search -->
                <form method="GET" class="mb-3 d-flex gap-2">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by title, description, tags..."
                           value="{{ request('search') }}">

                    <button class="btn btn-primary">Search</button>

                    @if(request('search') || request('status'))
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
                                        <strong>{{ \Illuminate\Support\Str::limit($item->title, 40) }}</strong>
                                    </td>

                                    <!-- Category -->
                                    <td>{{ $item->category->name ?? 'N/A' }}</td>

                                    <!-- City -->
                                    <td>{{ $item->city ?? '—' }}</td>

                                    <!-- Media -->
                                    <td>
                                        @if($item->media_path)
                                   
                                            @if(Str::endsWith($item->media_path, '.mp4'))
                                                <span class="badge bg-dark">Video</span>
                                            @else
                                                <img src="{{ asset('storage/' . $item->media_path) }}"
                                                     width="40" height="40"
                                                     class="rounded object-fit-cover">
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
                                    <td colspan="7" class="text-center text-muted py-4">
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
</style>
@endpush