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
                            <span id="short_description_word_count">0</span>/60 words
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
                            <select class="form-select" id="state_id" disabled>
                                <option value="1" selected>Rajasthan</option>
                            </select>
                            <input type="hidden" name="state_id" value="1">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <select class="form-select" id="city_id" disabled>
                                <option value="1" selected>Jaipur</option>
                            </select>
                            <input type="hidden" name="city_id" value="1">
                        </div>
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

                    <!-- Media Type -->
                    <div class="mb-3">
                        <label class="form-label">Media Type</label>
                        <select class="form-select" id="media_type" name="media_type">
                            @php
                                $defaultMediaType = $news->media_type
                                    ?: (Str::endsWith((string) $news->media_path, '.mp4') ? 'video' : 'image');
                                $selectedMediaType = old('media_type', $defaultMediaType ?: 'image');
                            @endphp
                            <option value="image" {{ $selectedMediaType === 'image' ? 'selected' : '' }}>Image</option>
                            <option value="video" {{ $selectedMediaType === 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        <div class="form-text text-muted">Choose media type to show/hide thumbnail field.</div>
                    </div>

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
                        @if($news->media_path)
                            <div class="form-text text-muted mt-1" id="autoRemoveHint">
                                Existing medil stay unless you remove it or upla wiload a new file.
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail (Required if new Media is Video) -->
                    <div class="mb-3" id="thumbnailWrapper">
                        <label class="form-label">Video Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnailInput" accept="image/*">

                        @if($news->thumbnail_path)
                            <div class="mt-2" id="existingThumbnailWrapper">
                                <img src="{{ asset('storage/' . $news->thumbnail_path) }}" class="img-fluid rounded mb-2">
                            </div>
                        @endif

                        <div class="form-text text-muted">
                            Upload thumbnail image (required only when uploading a new video).
                        </div>
                    </div>

                    <!-- Push -->
                    <div class="form-check">
                        @php
                            $pushAlreadySent = !empty($news->push_sent_at);
                            $pushChecked = (bool) old('send_push_notification', $news->send_push_notification);
                        @endphp

                        @if($pushAlreadySent && $pushChecked)
                            <input type="hidden" name="send_push_notification" value="1">
                        @endif

                        <input class="form-check-input" type="checkbox" id="send_push_notification" name="send_push_notification" value="1"
                               {{ $pushChecked ? 'checked' : '' }}
                               {{ $pushAlreadySent ? 'disabled' : '' }}>
                        <label class="form-check-label" for="send_push_notification">Send Push Notification</label>
                        @if($pushAlreadySent)
                            <div class="form-text text-muted">Notification already sent once. It will not be sent again on edit.</div>
                        @endif
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

    const shortDesc = document.getElementById('short_description');
    const wordCountEl = document.getElementById('short_description_word_count');
    const WORD_LIMIT = 60;

    function countWords(text) {
        const trimmed = (text || '').trim();
        if (!trimmed) return 0;
        return trimmed.split(/\s+/).filter(Boolean).length;
    }

    function updateWordCount() {
        if (!shortDesc || !wordCountEl) return;
        const words = countWords(shortDesc.value);
        wordCountEl.textContent = String(words);
        shortDesc.classList.toggle('is-invalid', words > WORD_LIMIT);
    }

    // Word count init + live update (60 words max hint)
    updateWordCount();
    if (shortDesc) {
        shortDesc.addEventListener('input', updateWordCount);
    }

    // Remove Media
    const btn = document.getElementById('removeMediaBtn');
    const input = document.getElementById('remove_media');
    const mediaInput = document.getElementById('mediaInput');
    const existingMediaWrapper = document.getElementById('existingMediaWrapper');
    const newMediaHint = document.getElementById('newMediaHint');
    const autoRemoveHint = document.getElementById('autoRemoveHint');

    if (btn) {
        btn.addEventListener('click', function() {
            input.value = "1";
            btn.closest('.mt-2').style.display = 'none';
            if (autoRemoveHint) autoRemoveHint.classList.add('d-none');
        });
    }

    // Keep existing media by default. Only remove when user clicks "Remove Media".

    // When selecting new file, hide existing preview immediately (UI only).
    if (mediaInput) {
        mediaInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                if (existingMediaWrapper) existingMediaWrapper.style.display = 'none';
                if (newMediaHint) newMediaHint.classList.remove('d-none');
                input.value = "0";
                if (autoRemoveHint) autoRemoveHint.classList.add('d-none');
            }
        });
    }

    // If new media is a video -> thumbnail required
    const thumbnailInput = document.getElementById('thumbnailInput');
    const thumbnailWrapper = document.getElementById('thumbnailWrapper');
    const mediaTypeSelect = document.getElementById('media_type');

    function setThumbnailVisibility(isVideo) {
        if (!thumbnailWrapper || !thumbnailInput) return;
        thumbnailWrapper.classList.toggle('d-none', !isVideo);
        thumbnailInput.required = !!isVideo;
        if (!isVideo) thumbnailInput.value = '';
    }

    function updateMediaUI() {
        const selected = mediaTypeSelect ? mediaTypeSelect.value : '';
        const hasNewMedia = !!(mediaInput && mediaInput.files && mediaInput.files.length > 0);
        const isVideo = hasNewMedia && (selected === 'video');
        setThumbnailVisibility(isVideo);
    }

    if (mediaTypeSelect) mediaTypeSelect.addEventListener('change', updateMediaUI);
    if (mediaInput) mediaInput.addEventListener('change', updateMediaUI);
    updateMediaUI();

});
</script>
@endpush