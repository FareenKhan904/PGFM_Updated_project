@extends('layouts.student')

@section('title', 'My Classes - Student Dashboard')

@section('page-title', 'My Classes')

@section('student-content')
<div class="mb-4">
    <h3 class="fw-bold mb-1" style="color: #10b981;">
        <i class="fas fa-chalkboard-teacher me-2"></i>Classes for Enrolled Courses
    </h3>
    <p class="text-muted">View all classes and access materials for your enrolled courses.</p>
</div>

@if($enrollments->count() > 0)
    @foreach($enrollments as $enrollment)
        @php
            $courseClasses = $classesByCourse->get($enrollment->course_id, collect());
        @endphp
        
        @if($courseClasses->count() > 0)
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; border-left: 4px solid #10b981;">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 15px 15px 0 0;">
                <h5 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>{{ $enrollment->course->title }}
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    @foreach($courseClasses as $class)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 3px solid #f59e0b;">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold" style="color: #2563eb;">{{ $class->title }}</h6>
                                    @php
                                        $materialCount = $class->materials()->where('is_active', true)->count();
                                    @endphp
                                    @if($materialCount > 0)
                                    <span class="badge bg-info rounded-pill">
                                        <i class="fas fa-file-alt me-1"></i>{{ $materialCount }}
                                    </span>
                                    @endif
                                </div>
                                
                                @if($class->description)
                                <p class="text-muted small mb-2">{{ Str::limit($class->description, 80) }}</p>
                                @endif
                                
                                @if($class->scheduled_at)
                                <p class="small mb-1">
                                    <i class="fas fa-clock me-1" style="color: #f59e0b;"></i>
                                    <strong>Scheduled:</strong> {{ $class->scheduled_at->format('M d, Y H:i') }}
                                </p>
                                @endif
                                
                                @if($class->duration)
                                <p class="small mb-2">
                                    <i class="fas fa-hourglass-half me-1" style="color: #10b981;"></i>
                                    <strong>Duration:</strong> {{ $class->duration }}
                                </p>
                                @endif
                                
                                @if($class->meeting_link)
                                <p class="small mb-3">
                                    <i class="fas fa-video me-1" style="color: #2563eb;"></i>
                                    <a href="{{ $class->meeting_link }}" target="_blank" class="text-decoration-none">Join Meeting</a>
                                </p>
                                @endif
                                
                                <div class="d-grid">
                                    <a href="{{ route('student.classes.materials', $class) }}" class="btn btn-sm text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
                                        <i class="fas fa-folder-open me-1"></i>View Materials
                                        @if($materialCount > 0)
                                        <span class="badge bg-white text-success ms-1">{{ $materialCount }}</span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    @endforeach

    @if($classes->count() == 0)
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body text-center p-5">
            <i class="fas fa-chalkboard-teacher fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">No Classes Available</h5>
            <p class="text-muted mb-0">There are no classes scheduled for your enrolled courses yet. Check back later!</p>
        </div>
    </div>
    @endif
@else
<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body text-center p-5">
        <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">No Enrolled Courses</h5>
        <p class="text-muted mb-4">You haven't enrolled in any courses yet. Browse available courses and enroll to access classes and materials.</p>
        <a href="{{ route('courses') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
            <i class="fas fa-search me-2"></i>Browse Courses
        </a>
    </div>
</div>
@endif
@endsection
