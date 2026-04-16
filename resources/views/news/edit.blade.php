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
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control"
                               name="title"
                               value="{{ old('title', $news->title) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control"
                                  id="short_description"
                                  name="short_description"
                                  rows="3"
                                  required>{{ old('short_description', $news->short_description) }}</textarea>
                        <div class="form-text text-muted">
                            <span id="short_description_word_count">0</span>/70 words
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
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
                            <label class="form-label">State *</label>
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
                            <label class="form-label">City *</label>
                            <select class="form-select" id="city_id" name="city_id" required>
                                <option value="">Select State First</option>
                            </select>
                        </div>
                    </div>

                    <!-- 🔥 IMPORTANT hidden field -->
                    <input type="hidden" id="old_city_id" value="{{ old('city_id', $news->city_id) }}">

                    <!-- Tags -->
                    <div class="mt-3">
                        <label class="form-label">Tags</label>
                        <input type="text" class="form-control"
                               name="tags"
                               value="{{ old('tags', $news->tags ? implode(', ', $news->tags) : '') }}">
                    </div>

                    <!-- Status -->
                    @php
                        $status = old('status', $news->status);
                    @endphp

                    <div class="mt-3">
                        <label class="form-label">Status *</label>
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
                        <input type="file" class="form-control" name="media">

                        @if($news->media_path)
                            <div class="mt-2">

                                <img src="{{ asset('storage/' . $news->media_path) }}" class="img-fluid rounded mb-2">

                                <!-- Remove Button -->
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm" id="removeMediaBtn">
                                        Remove Media
                                    </button>
                                </div>

                            </div>
                        @endif

                        <!-- Hidden field -->
                        <input type="hidden" name="remove_media" id="remove_media" value="0">
                    </div>

                    <!-- Push -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="send_push_notification"
                               value="1"
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');
    const oldCityId = document.getElementById('old_city_id').value;
    const shortDescription = document.getElementById('short_description');
    const wordCountEl = document.getElementById('short_description_word_count');
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

    function loadCities(stateId, selectedCityId = null) {

        citySelect.innerHTML = '<option value="">Loading...</option>';

        fetch(`/get-cities/${stateId}`)
        .then(response => response.json())
        .then(data => {

            citySelect.innerHTML = '<option value="">Select City</option>';

            data.forEach(city => {
                let option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name;

                if (selectedCityId && selectedCityId == city.id) {
                    option.selected = true;
                }

                citySelect.appendChild(option);
            });

        });
    }

    // On state change
    stateSelect.addEventListener('change', function() {
        if (this.value) {
            loadCities(this.value);
        }
    });

    // 🔥 Edit page load
    if (stateSelect.value) {
        loadCities(stateSelect.value, oldCityId);
    }

    // Word counter (Hindi/English both)
    if (shortDescription) {
        shortDescription.addEventListener('input', updateWordCount);
        updateWordCount();
    }

    // Remove media button functionality
    var removeMediaBtn = document.getElementById('removeMediaBtn');
    var removeMediaInput = document.getElementById('remove_media');
    if (removeMediaBtn && removeMediaInput) {
        removeMediaBtn.addEventListener('click', function() {
            removeMediaInput.value = "1";
            // Optionally, hide the preview image and button
            var parent = removeMediaBtn.closest('.mt-2');
            if (parent) {
                parent.style.display = 'none';
            }
        });
    }

});
</script>
@endpush