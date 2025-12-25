@extends('layouts.doctor')

@section('title', 'Edit Class - Doctor Dashboard')

@section('doctor-content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Class</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('doctor.classes.update', $class) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                        <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                            <option value="">-- Select a Course --</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $class->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                                @if($course->fee)
                                - PKR {{ number_format($course->fee, 2) }}
                                @endif
                            </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Select the course for which this class is scheduled</small>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Class Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $class->title) }}" required placeholder="e.g., Introduction to Family Medicine">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $class->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="scheduled_at" class="form-label">Scheduled Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('scheduled_at') is-invalid @enderror" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at', $class->scheduled_at ? $class->scheduled_at->format('Y-m-d\TH:i') : '') }}" required>
                            @error('scheduled_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $class->duration) }}" placeholder="e.g., 1 hour, 90 minutes">
                            <small class="form-text text-muted">Class duration</small>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="meeting_link" class="form-label">Meeting Link</label>
                        <input type="url" class="form-control @error('meeting_link') is-invalid @enderror" id="meeting_link" name="meeting_link" value="{{ old('meeting_link', $class->meeting_link) }}" placeholder="https://meet.google.com/...">
                        <small class="form-text text-muted">Zoom, Google Meet, or other meeting platform URL</small>
                        @error('meeting_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $class->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible to students)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor.classes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i>Update Class
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

