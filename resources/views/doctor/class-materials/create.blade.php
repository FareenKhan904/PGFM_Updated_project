@extends('layouts.doctor')

@section('title', 'Add Material - Doctor Dashboard')

@section('page-title', 'Add Material to: ' . $class->title)

@section('doctor-content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border-radius: 15px 15px 0 0;">
                <h4 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Add Material to Class
                </h4>
                <small class="opacity-75">{{ $class->title }}</small>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('doctor.class-materials.store', $class) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Material Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="e.g., Lecture Notes Chapter 1">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Brief description of the material...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Material Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">-- Select Type --</option>
                            <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF Document</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video File</option>
                            <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>Word Document</option>
                            <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>External Link</option>
                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Upload Section -->
                    <div class="mb-3" id="fileSection">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf,.doc,.docx,.mp4,.avi,.mov,.mp3">
                        <small class="form-text text-muted">Supported formats: PDF, DOC, DOCX, MP4, AVI, MOV, MP3 (Max: 100MB)</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- External Link Section -->
                    <div class="mb-3" id="linkSection" style="display: none;">
                        <label for="external_link" class="form-label">External Link</label>
                        <input type="url" class="form-control @error('external_link') is-invalid @enderror" id="external_link" name="external_link" value="{{ old('external_link') }}" placeholder="https://youtube.com/watch?v=...">
                        <small class="form-text text-muted">Enter a URL for YouTube videos, Google Drive links, etc.</small>
                        @error('external_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : 'checked' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible to students)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor.class-materials.index', $class) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Add Material
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('type').addEventListener('change', function() {
    const type = this.value;
    const fileSection = document.getElementById('fileSection');
    const linkSection = document.getElementById('linkSection');
    const fileInput = document.getElementById('file');
    const linkInput = document.getElementById('external_link');
    
    if (type === 'link') {
        fileSection.style.display = 'none';
        linkSection.style.display = 'block';
        fileInput.removeAttribute('required');
        linkInput.setAttribute('required', 'required');
    } else {
        fileSection.style.display = 'block';
        linkSection.style.display = 'none';
        linkInput.removeAttribute('required');
        if (type !== '') {
            fileInput.setAttribute('required', 'required');
        }
    }
});

// Trigger on page load if type is already selected
if (document.getElementById('type').value === 'link') {
    document.getElementById('type').dispatchEvent(new Event('change'));
}
</script>
@endsection
