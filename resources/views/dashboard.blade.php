@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Total News</h4>
                    <div class="icon-box bg-primary">
                        <i data-lucide="file-text"></i>
                    </div>
                </div>
                <h2 class="text-center mt-3">{{ $totalNews ?? 0 }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Pending News</h4>
                    <div class="icon-box bg-warning">
                        <i data-lucide="clock"></i>
                    </div>
                </div>
                <h2 class="text-center mt-3">{{ $pendingNews ?? 0 }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection