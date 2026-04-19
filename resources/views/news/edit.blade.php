@extends('dashboard')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
        <li class="breadcrumb-item active">Edit News</li>
    </ol>
</nav>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Edit News</h4>

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- LEFT -->
                <div class="col-md-8">

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title"  value="{{ old('title', $news->title) }}" required>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control"
                                  id="short_description"
                                  name="short_description"
                                  rows="3"
                                  required>{{ old('short_description', $news->short_description) }}</textarea>
                        <div class="form-text text-muted">
                            <span id="short_description_word_count">0</span>/70 words
                        </div>
                    </div>

                    <!-- Source Link -->
                    <div class="mb-3">
                        <label class="form-label">Source Link</label>
                        <input type="url" class="form-control"
                               name="source_link"
                               placeholder="https://example.com"
                               value="{{ old('source_link', $news->source_link) }}">
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- State + City -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <select class="form-select" id="state_id" name="state_id" required>
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('state_id', $news->state_id) == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <select class="form-select" id="city_id" name="city_id" required>
                                <option value="">Select State First</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="old_city_id" value="{{ old('city_id', $news->city_id) }}">

                    <!-- Tags -->
                    <div class="mt-3">
                        <label class="form-label">Tags</label>
                        <input type="text" class="form-control"
                               name="tags"
                               value="{{ old('tags', $news->tags ? implode(', ', $news->tags) : '') }}">
                    </div>

                    <!-- Status -->
                    @php $status = old('status', $news->status); @endphp

                    <div class="mt-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" required>
                            <option value="">Select Status</option>
                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>

                            @if(auth()->user()->role != 'reporter')
                                <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Published</option>
                            @endif

                            <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-4">

                    <!-- Media -->
                    <div class="mb-3">
                        <label class="form-label">Media</label>
                        <input type="file" class="form-control" name="media" id="mediaInput">

                        @if($news->media_path)
                            <div class="mt-2" id="existingMediaWrapper">

                                @php
                                    $ext = strtolower(pathinfo($news->media_path, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($ext, ['jpg','jpeg','png','webp']))
                                    <!-- Image Preview -->
                                    <img src="{{ asset('storage/' . $news->media_path) }}" class="img-fluid rounded mb-2">
                                @elseif(in_array($ext, ['mp4','webm','ogg']))
                                    <!-- Video Preview -->
                                    <video class="img-fluid rounded mb-2" controls>
                                        <source src="{{ asset('storage/' . $news->media_path) }}" type="video/mp4">
                                        Your browser does not support video
                                    </video>
                                @endif

                                <!-- Remove Button -->
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm" id="removeMediaBtn">
                                        Remove Media
                                    </button>
                                </div>

                            </div>
                        @endif
                        
                        <div class="form-text text-muted d-none" id="newMediaHint">
                            New media selected. Save to replace existing media.
                        </div>

                        <input type="hidden" name="remove_media" id="remove_media" value="0">
                    </div>

                    <!-- Push -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  id="send_push_notification" name="send_push_notification" value="1"
                               {{ old('send_push_notification', $news->send_push_notification) ? 'checked' : '' }}>
                        <label class="form-check-label" for="send_push_notification">Send Push Notification</label>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');
    const oldCityId = document.getElementById('old_city_id').value;
    const shortDesc = document.getElementById('short_description');
    const wordCountEl = document.getElementById('short_description_word_count');

    function countWords(text) {
        const trimmed = (text || '').trim();
        if (!trimmed) return 0;
        return trimmed.split(/\s+/).filter(Boolean).length;
    }

    function updateWordCount() {
        if (!shortDesc || !wordCountEl) return;
        wordCountEl.textContent = String(countWords(shortDesc.value));
    }

    function loadCities(stateId, selectedCityId = null) {
        citySelect.innerHTML = '<option value="">Loading...</option>';

        fetch(`/get-cities/${stateId}`)
        .then(res => res.json())
        .then(data => {
            citySelect.innerHTML = '<option value="">Select City</option>';
            data.forEach(city => {
                let option = new Option(city.name, city.id);
                if (selectedCityId && selectedCityId == city.id) {
                    option.selected = true;
                }
                citySelect.add(option);
            });
        });
    }

    if (stateSelect.value) {
        loadCities(stateSelect.value, oldCityId);
    }

    // Word count init + live update (70 words max hint)
    updateWordCount();
    if (shortDesc) {
        shortDesc.addEventListener('input', updateWordCount);
    }

    stateSelect.addEventListener('change', function() {
        if (this.value) loadCities(this.value);
    });

    // Remove Media
    const btn = document.getElementById('removeMediaBtn');
    const input = document.getElementById('remove_media');
    const mediaInput = document.getElementById('mediaInput');
    const existingMediaWrapper = document.getElementById('existingMediaWrapper');
    const newMediaHint = document.getElementById('newMediaHint');

    if (btn) {
        btn.addEventListener('click', function() {
            input.value = "1";
            btn.closest('.mt-2').style.display = 'none';
        });
    }

    // When selecting new file, hide existing preview immediately (UI only).
    if (mediaInput) {
        mediaInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                if (existingMediaWrapper) existingMediaWrapper.style.display = 'none';
                if (newMediaHint) newMediaHint.classList.remove('d-none');
                input.value = "0";
            }
        });
    }

});
</script>
@endpush