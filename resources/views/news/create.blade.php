@extends('dashboard')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create News</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create News Article</h4>
                    
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Left Column -->
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                                              id="short_description" name="short_description" rows="3"
                                              placeholder="Maximum 70 words "
                                              required>{{ old('short_description') }}</textarea>
                                    <div class="form-text text-muted">
                                        <span id="short_description_word_count">0</span>/70 words
                                    </div>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                   <!-- Source Link -->
                    <div class="mb-3">
                        <label class="form-label">Source Link</label>
                        <input type="url" class="form-control"
                               name="source_link"
                               placeholder="https://example.com"
                               >
                    </div>
                                <!-- Category and City Row -->
                                <div class="row g-3 mb-3">
                                    <div class="col-md-12">
                                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                                id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                </div>
                                
                                <!-- State and City Dropdowns Row -->
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                                        <select class="form-select @error('state_id') is-invalid @enderror" 
                                                id="state_id" name="state_id" required>
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city_id" class="form-label">City <span class="text-danger">*</span></label>
                                        <select class="form-select @error('city_id') is-invalid @enderror" 
                                                id="city_id" name="city_id" required>
                                            <option value="">Select State First</option>
                                        </select>
                                        @error('city_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Tags -->
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" name="tags" value="{{ old('tags') }}" 
                                           placeholder="Enter tags separated by commas">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="col-md-4">
                                <!-- Media Type -->
                                <div class="mb-3">
                                    <label for="media_type" class="form-label">Media Type</label>
                                    <select class="form-select @error('media_type') is-invalid @enderror"
                                            id="media_type" name="media_type">
                                        <option value="image" {{ old('media_type', 'image') === 'image' ? 'selected' : '' }}>Image</option>
                                        <option value="video" {{ old('media_type', 'image') === 'video' ? 'selected' : '' }}>Video</option>
                                    </select>
                                    @error('media_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted mt-1">Choose media type to show/hide thumbnail field.</div>
                                </div>

                                <!-- Media Upload -->
                                <div class="mb-3">
                                    <label for="media" class="form-label">Media</label>
                                    <input type="file" class="form-control @error('media') is-invalid @enderror" 
                                           id="media" name="media" accept="image/*,video/*">
                                    @error('media')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted mt-1">Supported formats: JPG, PNG, GIF, MP4 (Max: 10MB)</div>
                                </div>

                                <!-- Thumbnail Upload (Required if Media is Video) -->
                                <div class="mb-3" id="thumbnailWrapper">
                                    <label for="thumbnail" class="form-label">Video Thumbnail</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                           id="thumbnail" name="thumbnail" accept="image/*">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted mt-1" id="thumbnailHelp">
                                        Upload thumbnail image (required only when media is a video).
                                    </div>
                                </div>
                  
                                <!-- Send Push Notification -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="send_push_notification" value="1" 
                                           id="send_push_notification" {{ old('send_push_notification') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="send_push_notification">
                                        Send Push Notification
                                    </label>
                                    <div class="form-text text-muted">Notify users about this news article</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('news.index') }}" class="btn btn-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Create News</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        border-radius: 12px;
    }
    .card-title {
        font-weight: 600;
        color: #2d3436;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #2d3436;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e1e5eb;
        padding: 0.6rem 1rem;
        transition: all 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4a6cf7;
        box-shadow: 0 0 0 0.2rem rgba(74,108,247,0.1);
    }
    .btn {
        border-radius: 8px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
    }
    .btn-primary {
        background-color: #4a6cf7;
        border-color: #4a6cf7;
    }
    .btn-primary:hover {
        background-color: #3a5ce5;
        border-color: #3a5ce5;
    }
    .btn-light {
        background-color: #f8f9fa;
        border-color: #e1e5eb;
        color: #5a6a7a;
    }
    .btn-light:hover {
        background-color: #e9ecef;
        border-color: #d4d9e0;
    }
    .breadcrumb {
        background: transparent;
        padding: 0.75rem 0;
    }
    .breadcrumb-item a {
        color: #4a6cf7;
        text-decoration: none;
    }
    .breadcrumb-item.active {
        color: #8e9aaf;
    }
    .border-top {
        border-top-color: #eef2f6 !important;
    }
    .form-check-input:checked {
        background-color: #4a6cf7;
        border-color: #4a6cf7;
    }
    .form-text {
        font-size: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const shortDescription = document.getElementById('short_description');
    const wordCountEl = document.getElementById('short_description_word_count');
    const mediaTypeSelect = document.getElementById('media_type');
    const mediaInput = document.getElementById('media');
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailWrapper = document.getElementById('thumbnailWrapper');
    const WORD_LIMIT = 70;

    function countWords(text) {
        return (text || '')
            .trim()
            .split(/\s+/u)
            .filter(Boolean)
            .length;
    }

    function updateWordCount() {
        if (!shortDescription || !wordCountEl) return;
        const words = countWords(shortDescription.value);
        wordCountEl.textContent = String(words);
        shortDescription.classList.toggle('is-invalid', words > WORD_LIMIT);
    }

    // Load cities when state changes
    stateSelect.addEventListener('change', function() {
        const stateId = this.value;
        
        // Reset city dropdown
        citySelect.innerHTML = '<option value="">Select City</option>';
        citySelect.disabled = true;

        if (!stateId) {
            citySelect.innerHTML = '<option value="">Select State First</option>';
            return;
        }

        // Fetch cities using fetch API
        fetch(`/get-cities/${stateId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken || '',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            citySelect.innerHTML = '<option value="">Select City</option>';
            
            if (data && data.length > 0) {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            } else {
                citySelect.innerHTML = '<option value="">No cities available</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching cities:', error);
            citySelect.innerHTML = '<option value="">Error loading cities</option>';
        });
    });

    // Load cities on page load if state is already selected
    if (stateSelect.value) {
        stateSelect.dispatchEvent(new Event('change'));
    }

    // Word counter (Hindi/English both)
    if (shortDescription) {
        shortDescription.addEventListener('input', updateWordCount);
        updateWordCount();
    }

    function setThumbnailVisibility(isVideo) {
        if (!thumbnailWrapper || !thumbnailInput) return;
        thumbnailWrapper.classList.toggle('d-none', !isVideo);
        thumbnailInput.required = !!isVideo;
        if (!isVideo) thumbnailInput.value = '';
    }

    function updateMediaUI() {
        const selected = mediaTypeSelect ? mediaTypeSelect.value : '';
        const isVideo = selected === 'video';
        setThumbnailVisibility(isVideo);

        if (mediaInput) {
            if (selected === 'video') mediaInput.accept = 'video/*';
            else if (selected === 'image') mediaInput.accept = 'image/*';
        }
    }

    if (mediaTypeSelect) mediaTypeSelect.addEventListener('change', updateMediaUI);
    if (mediaInput) mediaInput.addEventListener('change', updateMediaUI);
    updateMediaUI();
});
</script>
@endpush