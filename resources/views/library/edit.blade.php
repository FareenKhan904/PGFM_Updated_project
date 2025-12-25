@extends('layouts.doctor')

@section('title', 'Edit Library Item - PGIFM')

@section('doctor-content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Library Item</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('library.update', $libraryItem) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $libraryItem->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="book" {{ old('type', $libraryItem->type) == 'book' ? 'selected' : '' }}>Book</option>
                                <option value="article" {{ old('type', $libraryItem->type) == 'article' ? 'selected' : '' }}>Article</option>
                                <option value="document" {{ old('type', $libraryItem->type) == 'document' ? 'selected' : '' }}>Document</option>
                                <option value="video" {{ old('type', $libraryItem->type) == 'video' ? 'selected' : '' }}>Video</option>
                                <option value="other" {{ old('type', $libraryItem->type) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $libraryItem->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $libraryItem->author) }}">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" value="{{ old('publisher', $libraryItem->publisher) }}">
                                @error('publisher')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $libraryItem->year) }}" min="1900" max="{{ date('Y') }}">
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($libraryItem->file_name)
                            <div class="alert alert-info">
                                <i class="fas fa-file me-2"></i>
                                <strong>Current file:</strong> {{ $libraryItem->file_name }}
                                <br><small>Upload a new file to replace it.</small>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload New File (Optional)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar">
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, RAR (Max: 10MB)</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="external_link" class="form-label">External Link</label>
                            <input type="url" class="form-control @error('external_link') is-invalid @enderror" id="external_link" name="external_link" value="{{ old('external_link', $libraryItem->external_link) }}" placeholder="https://example.com">
                            <small class="form-text text-muted">Provide a link to an external resource</small>
                            @error('external_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $libraryItem->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (visible to public)
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('library.manage') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

