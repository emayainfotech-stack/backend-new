@extends('dashboard')

@section('content')
   <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit News</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit News</h4>

            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Left -->
                    <div class="col-md-8">

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $news->title) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea class="form-control" name="short_description" rows="3"
                                      maxlength="700"
                                      placeholder="Maximum 70 words "
                                      required>{{ old('short_description', $news->short_description) }}</textarea>
                            <div class="form-text text-muted">Maximum 70 words</div>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- State + City -->
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">State *</label>
                                <select class="form-select" id="state_id" name="state_id" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id', $news->state_id) == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City *</label>
                                <select class="form-select" id="city_id" name="city_id" required>
                                    <option value="">Select State First</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mt-3">
                            <label class="form-label">Tags</label>
                            <input type="text" class="form-control" name="tags"
                                value="{{ old('tags', $news->tags ? implode(', ', $news->tags) : '') }}">
                        </div>

                    </div>

                    <!-- Right -->
                    <div class="col-md-4">

                        <!-- Media -->
                        <div class="mb-3">
                            <label class="form-label">Media</label>
                            <input type="file" class="form-control" name="media">

                            @if($news->media_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $news->media_path) }}" class="img-fluid rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Push -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="send_push_notification" value="1"
                                {{ old('send_push_notification', $news->send_push_notification) ? 'checked' : '' }}>
                            <label class="form-check-label">Send Push Notification</label>
                        </div>

                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('news.index') }}" class="btn btn-light">Cancel</a>
                    <button class="btn btn-primary">Update News</button>
                </div>
            </form>
        </div>
    </div>

@endsection