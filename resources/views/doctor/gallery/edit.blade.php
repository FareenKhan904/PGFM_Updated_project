@extends('layouts.doctor')

@section('title', 'Edit Gallery Item - Website Management')

@section('doctor-content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Gallery Item</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('doctor.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Current Image" style="max-width: 100%; max-height: 300px; border-radius: 8px; border: 1px solid #dee2e6;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Leave empty to keep current image. Recommended formats: JPEG, PNG, GIF, WebP. Max file size: 5MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 300px; border-radius: 8px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}" placeholder="e.g., Student Success Event">
                        <small class="form-text text-muted">Title for the gallery item</small>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="e.g., A memorable event celebrating our students' achievements">{{ old('description', $gallery->description) }}</textarea>
                        <small class="form-text text-muted">Description or caption for the gallery item</small>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $gallery->order) }}" min="0">
                            <small class="form-text text-muted">Lower numbers appear first (0, 1, 2, ...)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active (visible on homepage)</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor.gallery.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Gallery Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection


