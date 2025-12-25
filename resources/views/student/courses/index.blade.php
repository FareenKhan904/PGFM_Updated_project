@extends('layouts.student')

@section('title', 'My Courses - Student Dashboard')

@section('page-title', 'My Courses')

@section('student-content')
<div class="mb-4">
    <h3 class="fw-bold mb-4" style="color: #10b981;">
        <i class="fas fa-graduation-cap me-2"></i>My Course Enrollments
    </h3>
    <p class="text-muted">View all your course enrollment requests and their status.</p>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-4" id="courseTabs" role="tablist" style="border-bottom: 2px solid #e5e7eb;">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" style="color: #f59e0b; font-weight: 600;">
            <i class="fas fa-clock me-2"></i>Pending
            @if($pendingEnrollments->count() > 0)
            <span class="badge bg-warning rounded-pill ms-2">{{ $pendingEnrollments->count() }}</span>
            @endif
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted" type="button" role="tab" style="color: #10b981; font-weight: 600;">
            <i class="fas fa-check-circle me-2"></i>Accepted
            @if($acceptedEnrollments->count() > 0)
            <span class="badge bg-success rounded-pill ms-2">{{ $acceptedEnrollments->count() }}</span>
            @endif
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" style="color: #ef4444; font-weight: 600;">
            <i class="fas fa-times-circle me-2"></i>Rejected
            @if($rejectedEnrollments->count() > 0)
            <span class="badge bg-danger rounded-pill ms-2">{{ $rejectedEnrollments->count() }}</span>
            @endif
        </button>
    </li>
</ul>

<!-- Tabs Content -->
<div class="tab-content" id="courseTabsContent">
    <!-- Pending Enrollments Tab -->
    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        @if($pendingEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($pendingEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #f59e0b;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-calendar me-1"></i>Requested: {{ $enrollment->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <span class="badge bg-warning rounded-pill">
                                <i class="fas fa-clock me-1"></i>Pending
                            </span>
                        </div>
                        
                        @if($enrollment->course->description)
                        <p class="text-muted small mb-3">{{ Str::limit($enrollment->course->description, 100) }}</p>
                        @endif
                        
                        <div class="mb-3">
                            @if($enrollment->course->duration)
                            <p class="text-muted small mb-1">
                                <i class="fas fa-clock me-1" style="color: #2563eb;"></i><strong>Duration:</strong> {{ $enrollment->course->duration }}
                            </p>
                            @endif
                            @if($enrollment->course->fee)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-rupee-sign me-1" style="color: #2563eb;"></i><strong>Fee:</strong> PKR {{ number_format($enrollment->course->fee, 2) }}
                            </p>
                            @endif
                        </div>
                        
                        <div class="alert alert-warning p-2 mb-0" style="font-size: 0.85rem;">
                            <i class="fas fa-info-circle me-1"></i>Your enrollment request is pending approval from the course instructor.
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center p-5">
                <i class="fas fa-clock fa-4x text-warning mb-3"></i>
                <h5 class="text-muted">No Pending Enrollments</h5>
                <p class="text-muted mb-4">You don't have any pending enrollment requests.</p>
                <a href="{{ route('courses') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
                    <i class="fas fa-search me-2"></i>Browse Courses
                </a>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Accepted Enrollments Tab -->
    <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
        @if($acceptedEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($acceptedEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #10b981;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-calendar me-1"></i>Accepted: {{ $enrollment->updated_at->format('M d, Y') }}
                                </p>
                            </div>
                            <span class="badge bg-success rounded-pill">
                                <i class="fas fa-check-circle me-1"></i>Accepted
                            </span>
                        </div>
                        
                        @if($enrollment->course->description)
                        <p class="text-muted small mb-3">{{ Str::limit($enrollment->course->description, 100) }}</p>
                        @endif
                        
                        <div class="mb-3">
                            @if($enrollment->course->duration)
                            <p class="text-muted small mb-1">
                                <i class="fas fa-clock me-1" style="color: #2563eb;"></i><strong>Duration:</strong> {{ $enrollment->course->duration }}
                            </p>
                            @endif
                            @if($enrollment->course->fee)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-rupee-sign me-1" style="color: #2563eb;"></i><strong>Fee:</strong> PKR {{ number_format($enrollment->course->fee, 2) }}
                            </p>
                            @endif
                        </div>
                        
                        @if($enrollment->notes)
                        <div class="alert alert-success p-2 mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-sticky-note me-1"></i>{{ $enrollment->notes }}
                        </div>
                        @endif
                        
                        <div class="alert alert-success p-2 mb-0" style="font-size: 0.85rem;">
                            <i class="fas fa-check-circle me-1"></i>Congratulations! Your enrollment has been accepted. You can now access course materials.
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center p-5">
                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                <h5 class="text-muted">No Accepted Enrollments</h5>
                <p class="text-muted mb-4">You don't have any accepted enrollments yet.</p>
                <a href="{{ route('courses') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
                    <i class="fas fa-search me-2"></i>Browse Courses
                </a>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Rejected Enrollments Tab -->
    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
        @if($rejectedEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($rejectedEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #ef4444;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-calendar me-1"></i>Rejected: {{ $enrollment->updated_at->format('M d, Y') }}
                                </p>
                            </div>
                            <span class="badge bg-danger rounded-pill">
                                <i class="fas fa-times-circle me-1"></i>Rejected
                            </span>
                        </div>
                        
                        @if($enrollment->course->description)
                        <p class="text-muted small mb-3">{{ Str::limit($enrollment->course->description, 100) }}</p>
                        @endif
                        
                        <div class="mb-3">
                            @if($enrollment->course->duration)
                            <p class="text-muted small mb-1">
                                <i class="fas fa-clock me-1" style="color: #2563eb;"></i><strong>Duration:</strong> {{ $enrollment->course->duration }}
                            </p>
                            @endif
                            @if($enrollment->course->fee)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-rupee-sign me-1" style="color: #2563eb;"></i><strong>Fee:</strong> PKR {{ number_format($enrollment->course->fee, 2) }}
                            </p>
                            @endif
                        </div>
                        
                        @if($enrollment->notes)
                        <div class="alert alert-danger p-2 mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-sticky-note me-1"></i><strong>Reason:</strong> {{ $enrollment->notes }}
                        </div>
                        @endif
                        
                        <div class="alert alert-danger p-2 mb-0" style="font-size: 0.85rem;">
                            <i class="fas fa-info-circle me-1"></i>Your enrollment request was not approved. Please contact the course instructor for more information.
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center p-5">
                <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>
                <h5 class="text-muted">No Rejected Enrollments</h5>
                <p class="text-muted mb-4">You don't have any rejected enrollments.</p>
                <a href="{{ route('courses') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px;">
                    <i class="fas fa-search me-2"></i>Browse Courses
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
