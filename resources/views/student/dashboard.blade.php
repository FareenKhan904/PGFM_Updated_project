@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('page-title', 'Dashboard')

@section('student-content')
<!-- Welcome Section -->
<div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden; background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);">
    <div class="card-body p-4 text-white">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="mb-2 fw-bold">
                    <i class="fas fa-user-graduate me-2"></i>Welcome, {{ auth()->user()->name }}!
                </h2>
                <p class="mb-0 opacity-90">Access your courses, library resources, and learning materials from this dashboard.</p>
            </div>
            <div class="d-none d-md-block">
                <i class="fas fa-graduation-cap fa-4x opacity-25"></i>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #f59e0b;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-clock fa-2x" style="color: #f59e0b;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #f59e0b;">{{ $pendingEnrollments->count() ?? 0 }}</h2>
                <p class="text-muted mb-2 small">Pending</p>
                <span class="badge rounded-pill" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                    Awaiting Approval
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #10b981;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-check-circle fa-2x" style="color: #10b981;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #10b981;">{{ $acceptedEnrollments->count() ?? 0 }}</h2>
                <p class="text-muted mb-2 small">Accepted</p>
                <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    Active Courses
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #ef4444;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-times-circle fa-2x" style="color: #ef4444;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #ef4444;">{{ $rejectedEnrollments->count() ?? 0 }}</h2>
                <p class="text-muted mb-2 small">Rejected</p>
                <span class="badge rounded-pill" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    Not Approved
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #2563eb;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-graduation-cap fa-2x" style="color: #2563eb;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #2563eb;">{{ ($enrollments->count() ?? 0) }}</h2>
                <p class="text-muted mb-2 small">Total Requests</p>
                <span class="badge rounded-pill" style="background: rgba(37, 99, 235, 0.1); color: #2563eb;">
                    All Enrollments
                </span>
            </div>
        </div>
    </div>
</div>

<!-- My Courses Section -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: #10b981;">
            <i class="fas fa-graduation-cap me-2"></i>My Course Enrollments
        </h3>
        <a href="{{ route('student.courses.index') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
            <i class="fas fa-eye me-2"></i>View All
        </a>
    </div>
    
    @if($enrollments && $enrollments->count() > 0)
    <div class="row g-4">
        @foreach($enrollments->take(6) as $enrollment)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid @if($enrollment->status == \App\Models\Enrollment::STATUS_PENDING) #f59e0b @elseif($enrollment->status == \App\Models\Enrollment::STATUS_ACCEPTED) #10b981 @else #ef4444 @endif;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</h5>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-calendar me-1"></i>{{ $enrollment->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        <span class="badge rounded-pill @if($enrollment->status == \App\Models\Enrollment::STATUS_PENDING) bg-warning @elseif($enrollment->status == \App\Models\Enrollment::STATUS_ACCEPTED) bg-success @else bg-danger @endif">
                            @if($enrollment->status == \App\Models\Enrollment::STATUS_PENDING)
                                <i class="fas fa-clock me-1"></i>Pending
                            @elseif($enrollment->status == \App\Models\Enrollment::STATUS_ACCEPTED)
                                <i class="fas fa-check-circle me-1"></i>Accepted
                            @else
                                <i class="fas fa-times-circle me-1"></i>Rejected
                            @endif
                        </span>
                    </div>
                    
                    @if($enrollment->course->description)
                    <p class="text-muted small mb-3">{{ Str::limit($enrollment->course->description, 80) }}</p>
                    @endif
                    
                    @if($enrollment->notes)
                    <div class="alert alert-@if($enrollment->status == \App\Models\Enrollment::STATUS_ACCEPTED) success @elseif($enrollment->status == \App\Models\Enrollment::STATUS_REJECTED) danger @else info @endif p-2 mb-0" style="font-size: 0.85rem;">
                        <i class="fas fa-sticky-note me-1"></i>{{ Str::limit($enrollment->notes, 60) }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body text-center p-5">
            <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">No Enrollments Yet</h5>
            <p class="text-muted mb-4">You haven't enrolled in any courses yet. Browse available courses and enroll to get started!</p>
            <a href="{{ route('courses') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
                <i class="fas fa-search me-2"></i>Browse Courses
            </a>
        </div>
    </div>
    @endif
</div>

<!-- My Classes Section -->
@php
    $acceptedEnrollmentIds = $acceptedEnrollments->pluck('course_id');
    $recentClasses = \App\Models\ClassItem::with(['course', 'materials'])
        ->whereIn('course_id', $acceptedEnrollmentIds)
        ->where('is_active', true)
        ->orderBy('scheduled_at', 'desc')
        ->take(6)
        ->get();
@endphp

@if($recentClasses->count() > 0)
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0" style="color: #10b981;">
            <i class="fas fa-chalkboard-teacher me-2"></i>Recent Classes
        </h3>
        <a href="{{ route('student.classes.index') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
            <i class="fas fa-eye me-2"></i>View All Classes
        </a>
    </div>
    
    <div class="row g-4">
        @foreach($recentClasses as $class)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #f59e0b;">
                <div class="card-body p-4">
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
                    
                    @if($class->course)
                    <p class="text-muted small mb-2">
                        <i class="fas fa-graduation-cap me-1"></i>{{ $class->course->title }}
                    </p>
                    @endif
                    
                    @if($class->scheduled_at)
                    <p class="small mb-2">
                        <i class="fas fa-clock me-1" style="color: #f59e0b;"></i>
                        {{ $class->scheduled_at->format('M d, Y H:i') }}
                    </p>
                    @endif
                    
                    <div class="d-grid mt-3">
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
@endif

<!-- Quick Access Cards -->
<div class="mb-4">
    <h3 class="fw-bold mb-4" style="color: #10b981;">
        <i class="fas fa-bolt me-2"></i>Quick Access
    </h3>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #2563eb;">
                <div class="card-body p-4 text-center">
                    <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book fa-2x" style="color: #2563eb;"></i>
                    </div>
                    <h5 class="mb-2 fw-bold" style="color: #2563eb;">Browse Courses</h5>
                    <p class="text-muted small mb-3">Explore and enroll in available courses</p>
                    <a href="{{ route('courses') }}" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>View Courses
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #17a2b8;">
                <div class="card-body p-4 text-center">
                    <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(19, 132, 150, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book-open fa-2x" style="color: #17a2b8;"></i>
                    </div>
                    <h5 class="mb-2 fw-bold" style="color: #17a2b8;">Library</h5>
                    <p class="text-muted small mb-3">Access books, articles, and study materials</p>
                    <a href="{{ route('library.index') }}" class="btn btn-outline-info btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>Visit Library
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #10b981;">
                <div class="card-body p-4 text-center">
                    <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-graduate fa-2x" style="color: #10b981;"></i>
                    </div>
                    <h5 class="mb-2 fw-bold" style="color: #10b981;">Mentorship</h5>
                    <p class="text-muted small mb-3">Get guidance from experienced mentors</p>
                    <a href="{{ route('mentorship') }}" class="btn btn-outline-success btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection