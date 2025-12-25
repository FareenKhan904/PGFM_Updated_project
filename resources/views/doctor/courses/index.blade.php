@extends('layouts.doctor')

@section('title', 'Courses - Doctor Dashboard')

@section('doctor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-book me-2 text-primary"></i>Courses</h2>
    <a href="{{ route('doctor.courses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Course
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($courses->count() > 0)
    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">{{ $course->title }}</h5>
                        <span class="badge {{ $course->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    @if($course->description)
                    <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                    @endif
                    
               
                    <div class="mb-3">
                        @if($course->duration)
                        <p class="mb-1">
                            <i class="fas fa-clock me-1 text-primary"></i>
                            <small><strong>Duration:</strong> {{ $course->duration }}</small>
                        </p>
                        @endif
                        
                        @if($course->fee)
                        <p class="mb-0">
                            <i class="fas fa-rupee-sign me-1 text-success"></i>
                            <small><strong>Fee:</strong> PKR {{ number_format($course->fee, 2) }}</small>
                        </p>
                        @endif
                    </div>
                    
                    <div class="btn-group btn-group-sm w-100">
                        <a href="{{ route('doctor.courses.edit', $course) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('doctor.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($courses->hasPages())
    <div class="mt-4">
        {{ $courses->links() }}
    </div>
    @endif
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5 text-center">
            <i class="fas fa-book fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No courses yet</h5>
            <p class="text-muted">Start by adding your first course.</p>
            <a href="{{ route('doctor.courses.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i>Add New Course
            </a>
        </div>
    </div>
@endif
@endsection

