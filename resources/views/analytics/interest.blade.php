@extends('dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Interest</li>
        </ol>
    </nav>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h4 class="mb-0">User Interest Analytics</h4>

        <form method="GET" class="d-flex flex-wrap gap-2 align-items-end">
            <div>
                <label class="form-label small mb-1">Quick</label>
                <select name="date" class="form-select form-select-sm">
                    @php $d = request('date'); @endphp
                    <option value="">All</option>
                    <option value="today" {{ $d === 'today' ? 'selected' : '' }}>Today</option>
                    <option value="7days" {{ $d === '7days' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="1month" {{ $d === '1month' ? 'selected' : '' }}>Last 1 Month</option>
                </select>
            </div>
            <div>
                <label class="form-label small mb-1">From</label>
                <input type="datetime-local" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
            </div>
            <div>
                <label class="form-label small mb-1">To</label>
                <input type="datetime-local" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary">Apply</button>
                <a href="{{ route('dashboard.interest') }}" class="btn btn-sm btn-light">Reset</a>
            </div>
        </form>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Clicks</div>
                    <div class="fs-3 fw-bold">{{ number_format($totalClicks) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Unique Devices</div>
                    <div class="fs-3 fw-bold">{{ number_format($uniqueDevices) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Range</div>
                    <div class="fw-semibold">
                        {{ $from ? $from->format('d M Y, h:i A') : 'All time' }}
                        —
                        {{ $to ? $to->format('d M Y, h:i A') : 'Now' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">Top Categories</h5>
                        <span class="text-muted small">Top 10</span>
                    </div>

                    @if($topCategories->isEmpty())
                        <div class="text-muted">No clicks yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th class="text-end">Clicks</th>
                                    <th style="width: 40%">Share</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topCategories as $row)
                                    <tr>
                                        <td class="fw-semibold">{{ $row->category_name }}</td>
                                        <td class="text-end">{{ number_format($row->clicks) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="progress flex-grow-1" style="height: 10px;">
                                                    <div class="progress-bar interest-share-bar" role="progressbar"
                                                         data-share="{{ $row->share }}"
                                                         style="width: 0%;"></div>
                                                </div>
                                                <div class="text-muted small" style="min-width: 52px;">{{ $row->share }}%</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">Top News</h5>
                        <span class="text-muted small">Top 10</span>
                    </div>

                    @if($topNews->count() === 0)
                        <div class="text-muted">No clicks yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th class="text-end">Clicks</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topNews as $row)
                                    <tr>
                                        <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($row->title, 52) }}</td>
                                        <td class="text-muted">{{ $row->category_name }}</td>
                                        <td class="text-end">{{ number_format($row->clicks) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($topNews->hasPages())
                            <div class="mt-3">
                                {{ $topNews->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">Most Active Devices</h5>
                        <span class="text-muted small">Top 10</span>
                    </div>

                    @if($deviceLeaders->count() === 0)
                        <div class="text-muted">No clicks yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                <tr>
                                    <th>Device ID</th>
                                    <th class="text-end">Clicks</th>
                                    <th class="text-end">Unique News</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($deviceLeaders as $row)
                                    <tr>
                                        <td class="font-monospace">{{ \Illuminate\Support\Str::limit($row->device_id, 40) }}</td>
                                        <td class="text-end">{{ number_format($row->clicks) }}</td>
                                        <td class="text-end">{{ number_format($row->unique_news) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($deviceLeaders->hasPages())
                            <div class="mt-3">
                                {{ $deviceLeaders->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.interest-share-bar').forEach(function (el) {
    const share = parseFloat(el.getAttribute('data-share') || '0');
    el.style.width = (isFinite(share) ? share : 0) + '%';
  });
});
</script>
@endpush

