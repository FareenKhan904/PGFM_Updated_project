@extends('layouts.doctor')

@section('title', 'Edit News - Doctor Dashboard')

@section('doctor-content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit News</h4>
            </div>
            <div class="card-body p-4">
                @if($news->image)
                <div class="mb-3">
                    <label class="form-label">Current Image</label>
                    <div>
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-thumbnail" style="max-height: 200px;">
                    </div>
                </div>
                @endif

                <form action="{{ route('doctor.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">News Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" required>{{ old('content', $news->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">News Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select News Type</option>
                            <option value="0" {{ old('type', $news->type) == 0 ? 'selected' : '' }}>Classes News</option>
                            <option value="1" {{ old('type', $news->type) == 1 ? 'selected' : '' }}>Reference News</option>
                        </select>
                        <small class="form-text text-muted">Select the type of news: Classes News (0) or Reference News (1)</small>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Change Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Leave empty to keep current image (max 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                Publish (visible to students)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor.news.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save me-2"></i>Update News
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



