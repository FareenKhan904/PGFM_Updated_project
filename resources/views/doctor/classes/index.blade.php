@extends('layouts.doctor')

@section('title', 'Classes - Doctor Dashboard')

@section('doctor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Classes</h2>
    <a href="{{ route('doctor.classes.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Schedule New Class
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($classes->count() > 0)
<div class="row g-4">
    @foreach($classes as $class)
    <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #f59e0b;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="card-title mb-1 fw-bold" style="color: #2563eb;">{{ $class->title }}</h5>
                        @if($class->course)
                        <p class="text-muted small mb-0">
                            <i class="fas fa-graduation-cap me-1" style="color: #10b981;"></i>
                            <strong>Course:</strong> {{ $class->course->title }}
                        </p>
                        @endif
                    </div>
                    <span class="badge rounded-pill {{ $class->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $class->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                @if($class->description)
                <p class="card-text text-muted mb-3">{{ Str::limit($class->description, 100) }}</p>
                @endif
                @if($class->scheduled_at)
                <p class="mb-2">
                    <i class="fas fa-clock me-1 text-primary"></i>
                    <small><strong>Scheduled:</strong> {{ $class->scheduled_at->format('M d, Y H:i') }}</small>
                </p>
                @endif
                @if($class->duration)
                <p class="mb-2">
                    <i class="fas fa-hourglass-half me-1 text-primary"></i>
                    <small><strong>Duration:</strong> {{ $class->duration }}</small>
                </p>
                @endif
                @if($class->meeting_link)
                <p class="mb-2">
                    <i class="fas fa-link me-1 text-primary"></i>
                    <a href="{{ $class->meeting_link }}" target="_blank" class="small">Meeting Link</a>
                </p>
                @endif
                <div class="mb-3">
                    <a href="{{ route('doctor.class-materials.index', $class) }}" class="btn btn-outline-info btn-sm w-100 mb-2" style="border-radius: 8px;">
                        <i class="fas fa-file-alt me-1"></i>Materials 
                        @php
                            $materialCount = $class->materials()->count();
                        @endphp
                        @if($materialCount > 0)
                        <span class="badge bg-info rounded-pill ms-1">{{ $materialCount }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('doctor.classes.edit', $class) }}" class="btn btn-outline-warning btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('doctor.classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this class?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100" style="border-radius: 8px;">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($classes->hasPages())
<div class="mt-4">
    {{ $classes->links() }}
</div>
@endif
@else
<div class="card border-0 shadow-sm">
    <div class="card-body p-5 text-center">
        <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">No classes scheduled yet</h5>
        <p class="text-muted">Start by scheduling your first class.</p>
        <a href="{{ route('doctor.classes.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus me-2"></i>Schedule New Class
        </a>
    </div>
</div>
@endif
@endsection

