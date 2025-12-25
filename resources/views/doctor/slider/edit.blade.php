@extends('layouts.doctor')

@section('title', 'Edit Slider Image - Website Management')

@section('doctor-content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Slider Image</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('doctor.slider.update', $sliderImage) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $sliderImage->image_path) }}" alt="Current Image" style="max-width: 100%; max-height: 300px; border-radius: 8px; border: 1px solid #dee2e6;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Leave empty to keep current image. Recommended size: 1920x500px or similar. Max file size: 5MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 300px; border-radius: 8px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $sliderImage->title) }}" placeholder="e.g., Postgraduate Family Institute of Medicine">
                        <small class="form-text text-muted">Main heading text displayed on the slider</small>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="e.g., Your Pathway to Medical Excellence">{{ old('description', $sliderImage->description) }}</textarea>
                        <small class="form-text text-muted">Subheading or description text</small>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $sliderImage->button_text) }}" placeholder="e.g., Explore Courses">
                            <small class="form-text text-muted">Text for the call-to-action button</small>
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="button_link" class="form-label">Button Link</label>
                            <input type="text" class="form-control @error('button_link') is-invalid @enderror" id="button_link" name="button_link" value="{{ old('button_link', $sliderImage->button_link) }}" placeholder="e.g., /courses or {{ route('courses') }}">
                            <small class="form-text text-muted">URL where the button should link to</small>
                            @error('button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $sliderImage->order) }}" min="0">
                            <small class="form-text text-muted">Lower numbers appear first (0, 1, 2, ...)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $sliderImage->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active (visible on homepage)</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor.slider.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Slider Image
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






