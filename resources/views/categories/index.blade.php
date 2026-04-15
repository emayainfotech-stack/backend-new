@extends('layouts.master')

@section('title', 'Categories')

@section('content')
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-arrwo">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categories List</li>
  </ol>
</nav>
 
    <div class="card">
        <div class="card-body">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0">Categories</h4>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i data-lucide="plus"></i> Add Category
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>News Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td>
                                    <span >{{ $category->news_count ?? 0 }} </span>
                                </td>
                                <td>{{ $category->created_at ? $category->created_at->format('d M Y') : '—' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="dropdown-item">
                                                <i data-lucide="edit"></i> Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No categories found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
@endsection
