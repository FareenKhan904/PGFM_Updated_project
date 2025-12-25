@extends('layouts.doctor')

@section('title', 'Enrollment Requests - Doctor Dashboard')

@section('page-title', 'Enrollment Requests')

@section('doctor-content')
<div class="mb-4">
    <h3 class="fw-bold mb-4" style="color: #2563eb;">
        <i class="fas fa-user-check me-2"></i>Manage Enrollment Requests
    </h3>
    <p class="text-muted">Review and manage student enrollment requests for your courses.</p>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-4" id="enrollmentTabs" role="tablist" style="border-bottom: 2px solid #e5e7eb;">
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
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="paused-tab" data-bs-toggle="tab" data-bs-target="#paused" type="button" role="tab" style="color: #6b7280; font-weight: 600;">
            <i class="fas fa-pause-circle me-2"></i>Paused
            @if($pausedEnrollments->count() > 0)
            <span class="badge bg-secondary rounded-pill ms-2">{{ $pausedEnrollments->count() }}</span>
            @endif
        </button>
    </li>
</ul>

<!-- Tabs Content -->
<div class="tab-content" id="enrollmentTabsContent">
    <!-- Pending Requests Tab -->
    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
        @if($pendingEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($pendingEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #f59e0b;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->user->name }}</h5>
                                <p class="text-muted small mb-0">{{ $enrollment->user->email }}</p>
                            </div>
                            <span class="badge bg-warning rounded-pill">Pending</span>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="mb-2" style="color: #4b5563;">
                                <i class="fas fa-graduation-cap me-2" style="color: #2563eb;"></i>{{ $enrollment->course->title }}
                            </h6>
                            @if($enrollment->course->fee)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-rupee-sign me-1"></i>Fee: PKR {{ number_format($enrollment->course->fee, 2) }}
                            </p>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>Requested: {{ $enrollment->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        
                        <form action="{{ route('doctor.enrollments.update', $enrollment->id) }}" method="POST" class="mb-2">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ \App\Models\Enrollment::STATUS_ACCEPTED }}">
                            <div class="mb-2">
                                <textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="Optional notes..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm w-100" style="border-radius: 8px;">
                                <i class="fas fa-check me-2"></i>Accept Request
                            </button>
                        </form>
                        
                        <form action="{{ route('doctor.enrollments.update', $enrollment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ \App\Models\Enrollment::STATUS_REJECTED }}">
                            <div class="mb-2">
                                <textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="Rejection reason (optional)..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-sm w-100" style="border-radius: 8px;">
                                <i class="fas fa-times me-2"></i>Reject Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center p-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">No Pending Requests</h5>
                <p class="text-muted mb-0">There are no pending enrollment requests at the moment.</p>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Accepted Requests Tab -->
    <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
        @if($acceptedEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($acceptedEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #10b981;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->user->name }}</h5>
                                <p class="text-muted small mb-0">{{ $enrollment->user->email }}</p>
                            </div>
                            <span class="badge bg-success rounded-pill">Accepted</span>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="mb-2" style="color: #4b5563;">
                                <i class="fas fa-graduation-cap me-2" style="color: #2563eb;"></i>{{ $enrollment->course->title }}
                            </h6>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>Accepted: {{ $enrollment->updated_at->format('M d, Y') }}
                            </small>
                        </div>
                        
                        @if($enrollment->notes)
                        <div class="alert alert-info p-2 mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-sticky-note me-1"></i>{{ $enrollment->notes }}
                        </div>
                        @endif
                        
                        <!-- Pause/Deactivate Button -->
                        <form action="{{ route('doctor.enrollments.update', $enrollment->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ \App\Models\Enrollment::STATUS_PAUSED }}">
                            <div class="mb-2">
                                <textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="Reason for pausing (e.g., Payment pending)..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm w-100" style="border-radius: 8px;" onclick="return confirm('Are you sure you want to pause this enrollment? The student will lose access to course materials.')">
                                <i class="fas fa-pause me-2"></i>Pause Enrollment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center p-5">
                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                <h5 class="text-muted">No Accepted Requests</h5>
                <p class="text-muted mb-0">No enrollment requests have been accepted yet.</p>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Rejected Requests Tab -->
    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
        @if($rejectedEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($rejectedEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #ef4444;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->user->name }}</h5>
                                <p class="text-muted small mb-0">{{ $enrollment->user->email }}</p>
                            </div>
                            <span class="badge bg-danger rounded-pill">Rejected</span>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="mb-2" style="color: #4b5563;">
                                <i class="fas fa-graduation-cap me-2" style="color: #2563eb;"></i>{{ $enrollment->course->title }}
                            </h6>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>Rejected: {{ $enrollment->updated_at->format('M d, Y') }}
                            </small>
                        </div>
                        
                        @if($enrollment->notes)
                        <div class="alert alert-danger p-2 mb-0" style="font-size: 0.85rem;">
                            <i class="fas fa-sticky-note me-1"></i>{{ $enrollment->notes }}
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
                <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>
                <h5 class="text-muted">No Rejected Requests</h5>
                <p class="text-muted mb-0">No enrollment requests have been rejected yet.</p>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Paused Requests Tab -->
    <div class="tab-pane fade" id="paused" role="tabpanel" aria-labelledby="paused-tab">
        @if($pausedEnrollments->count() > 0)
        <div class="row g-4">
            @foreach($pausedEnrollments as $enrollment)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid #6b7280;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $enrollment->user->name }}</h5>
                                <p class="text-muted small mb-0">{{ $enrollment->user->email }}</p>
                            </div>
                            <span class="badge bg-secondary rounded-pill">Paused</span>
                        </div>
                        
                        <div class="mb-3">
                            <h6 class="mb-2" style="color: #4b5563;">
                                <i class="fas fa-graduation-cap me-2" style="color: #2563eb;"></i>{{ $enrollment->course->title }}
                            </h6>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>Paused: {{ $enrollment->updated_at->format('M d, Y') }}
                            </small>
                        </div>
                        
                        @if($enrollment->notes)
                        <div class="alert alert-warning p-2 mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-sticky-note me-1"></i>{{ $enrollment->notes }}
                        </div>
                        @endif
                        
                        <!-- Reactivate Button -->
                        <form action="{{ route('doctor.enrollments.update', $enrollment->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ \App\Models\Enrollment::STATUS_ACCEPTED }}">
                            <div class="mb-2">
                                <textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="Optional notes (e.g., Payment received)..." ></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm w-100" style="border-radius: 8px;">
                                <i class="fas fa-play me-2"></i>Reactivate Enrollment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center p-5">
                <i class="fas fa-pause-circle fa-4x text-secondary mb-3"></i>
                <h5 class="text-muted">No Paused Enrollments</h5>
                <p class="text-muted mb-0">No enrollments have been paused yet.</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
