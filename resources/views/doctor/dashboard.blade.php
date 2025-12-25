@extends('layouts.doctor')

@section('title', 'Doctor Dashboard')

@section('page-title', 'Dashboard')

@section('doctor-content')
<!-- Welcome Section -->
<div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden; background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%);">
    <div class="card-body p-4 text-white">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="mb-2 fw-bold">
                    <i class="fas fa-user-md me-2"></i>Welcome, Dr. {{ auth()->user()->name }}!
                </h2>
                <p class="mb-0 opacity-90">Manage your courses, news, classes, and library resources from this dashboard.</p>
            </div>
            <div class="d-none d-md-block">
                <i class="fas fa-chart-line fa-4x opacity-25"></i>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #2563eb;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-graduation-cap fa-2x" style="color: #2563eb;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #2563eb;">{{ $stats['courses'] ?? 0 }}</h2>
                <p class="text-muted mb-2 small">Total Courses</p>
                <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="fas fa-check-circle me-1"></i>{{ $stats['active_courses'] ?? 0 }} Active
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #8b5cf6;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users fa-2x" style="color: #8b5cf6;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #8b5cf6;">{{ $stats['total_enrollments'] ?? 0 }}</h2>
                <p class="text-muted mb-2 small">Total Enrollments</p>
                <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="fas fa-check-circle me-1"></i>{{ $stats['active_enrollments'] ?? 0 }} Active
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #17a2b8;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(19, 132, 150, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-newspaper fa-2x" style="color: #17a2b8;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #17a2b8;">{{ $stats['news'] ?? 0 }}</h2>
                <p class="text-muted mb-2 small">News Items</p>
                <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="fas fa-check-circle me-1"></i>{{ $stats['published_news'] ?? 0 }} Published
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: all 0.3s ease; border-left: 4px solid #f59e0b;">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chalkboard-teacher fa-2x" style="color: #f59e0b;"></i>
                </div>
                <h2 class="mb-1 fw-bold" style="color: #f59e0b;">{{ $stats['classes'] ?? 0 }}</h2>
                <p class="text-muted mb-2 small">Classes</p>
                <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="fas fa-check-circle me-1"></i>{{ $stats['active_classes'] ?? 0 }} Active
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Enrolled Students Section -->
<div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 p-4" style="border-bottom: 2px solid #e5e7eb;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 fw-bold" style="color: #2563eb;">
                    <i class="fas fa-users me-2"></i>Enrolled Students
                </h3>
                <p class="text-muted small mb-0">View all student enrollments with complete details</p>
            </div>
            <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-primary btn-sm" style="border-radius: 8px;">
                <i class="fas fa-external-link-alt me-1"></i>Manage All
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs border-0 px-4 pt-3" id="enrollmentTabs" role="tablist" style="border-bottom: 2px solid #e5e7eb;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" style="color: #2563eb; font-weight: 600; border: none; border-bottom: 3px solid transparent;">
                    <i class="fas fa-list me-2"></i>All
                    <span class="badge bg-secondary rounded-pill ms-2">{{ $enrollments->count() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted" type="button" role="tab" style="color: #10b981; font-weight: 600; border: none; border-bottom: 3px solid transparent;">
                    <i class="fas fa-check-circle me-2"></i>Accepted
                    <span class="badge bg-success rounded-pill ms-2">{{ $stats['accepted_enrollments'] ?? 0 }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" style="color: #f59e0b; font-weight: 600; border: none; border-bottom: 3px solid transparent;">
                    <i class="fas fa-clock me-2"></i>Pending
                    <span class="badge bg-warning rounded-pill ms-2">{{ $stats['pending_enrollments'] ?? 0 }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" style="color: #ef4444; font-weight: 600; border: none; border-bottom: 3px solid transparent;">
                    <i class="fas fa-times-circle me-2"></i>Rejected
                    <span class="badge bg-danger rounded-pill ms-2">{{ $stats['rejected_enrollments'] ?? 0 }}</span>
                </button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content p-4" id="enrollmentTabsContent">
            <!-- All Enrollments Tab -->
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                @if($enrollments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Student</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Course</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Enrolled</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Status</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Details</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments->take(10) as $enrollment)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem;">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-bold" style="color: #111827;">{{ $enrollment->user->name }}</div>
                                            <div class="text-muted small">{{ $enrollment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</div>
                                    @if($enrollment->course->duration)
                                    <div class="text-muted small">
                                        <i class="fas fa-clock me-1"></i>{{ $enrollment->course->duration }}
                                    </div>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="text-muted small">
                                        <i class="fas fa-calendar-alt me-1"></i>{{ $enrollment->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">
                                        {{ $enrollment->created_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    @if($enrollment->status == \App\Models\Enrollment::STATUS_PENDING)
                                        <span class="badge rounded-pill bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                    @elseif($enrollment->status == \App\Models\Enrollment::STATUS_ACCEPTED)
                                        @if($enrollment->isExpired())
                                            <span class="badge rounded-pill bg-secondary">
                                                <i class="fas fa-ban me-1"></i>Expired
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @endif
                                    @else
                                        <span class="badge rounded-pill bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>Rejected
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    @if($enrollment->status == \App\Models\Enrollment::STATUS_ACCEPTED && $enrollment->approved_at)
                                        <div class="text-muted small">
                                            <strong>Approved:</strong> {{ $enrollment->approved_at->format('M d, Y') }}
                                        </div>
                                        @if(!$enrollment->isExpired())
                                            @php
                                                $expirationDate = $enrollment->getExpirationDate();
                                                $daysRemaining = $enrollment->getDaysRemaining();
                                            @endphp
                                            @if($expirationDate)
                                                <div class="text-muted small">
                                                    <strong>Expires:</strong> {{ $expirationDate->format('M d, Y') }}
                                                </div>
                                                @if($daysRemaining !== null)
                                                    <div class="small @if($daysRemaining <= 7) text-danger @elseif($daysRemaining <= 30) text-warning @else text-success @endif">
                                                        <i class="fas fa-hourglass-half me-1"></i>{{ $daysRemaining }} days left
                                                    </div>
                                                @endif
                                            @endif
                                        @else
                                            <div class="text-danger small">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Expired
                                            </div>
                                        @endif
                                    @endif
                                    @if($enrollment->notes)
                                        <div class="text-muted small mt-1" title="{{ $enrollment->notes }}">
                                            <i class="fas fa-sticky-note me-1"></i>{{ Str::limit($enrollment->notes, 30) }}
                                        </div>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($enrollments->count() > 10)
                <div class="text-center mt-3">
                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-outline-primary" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>View All {{ $enrollments->count() }} Enrollments
                    </a>
                </div>
                @endif
                @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Enrollments Yet</h5>
                    <p class="text-muted">Students haven't enrolled in any of your courses yet.</p>
                </div>
                @endif
            </div>

            <!-- Accepted Enrollments Tab -->
            <div class="tab-pane fade" id="accepted" role="tabpanel">
                @if($acceptedEnrollments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Student</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Course</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Approved</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Expiration</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Status</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acceptedEnrollments->take(10) as $enrollment)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem;">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-bold" style="color: #111827;">{{ $enrollment->user->name }}</div>
                                            <div class="text-muted small">{{ $enrollment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</div>
                                    @if($enrollment->course->duration)
                                    <div class="text-muted small">
                                        <i class="fas fa-clock me-1"></i>{{ $enrollment->course->duration }}
                                    </div>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    @if($enrollment->approved_at)
                                        <div class="text-muted small">
                                            <i class="fas fa-calendar-check me-1"></i>{{ $enrollment->approved_at->format('M d, Y') }}
                                        </div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">
                                            {{ $enrollment->approved_at->format('h:i A') }}
                                        </div>
                                    @else
                                        <span class="text-muted small">N/A</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    @php
                                        $expirationDate = $enrollment->getExpirationDate();
                                        $daysRemaining = $enrollment->getDaysRemaining();
                                    @endphp
                                    @if($expirationDate)
                                        <div class="text-muted small">
                                            <strong>{{ $expirationDate->format('M d, Y') }}</strong>
                                        </div>
                                        @if($enrollment->isExpired())
                                            <div class="text-danger small">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Expired
                                            </div>
                                        @elseif($daysRemaining !== null)
                                            <div class="small @if($daysRemaining <= 7) text-danger @elseif($daysRemaining <= 30) text-warning @else text-success @endif">
                                                <i class="fas fa-hourglass-half me-1"></i>{{ $daysRemaining }} days left
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-muted small">Never expires</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    @if($enrollment->isExpired())
                                        <span class="badge rounded-pill bg-secondary">
                                            <i class="fas fa-ban me-1"></i>Expired
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Active
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($acceptedEnrollments->count() > 10)
                <div class="text-center mt-3">
                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-outline-primary" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>View All {{ $acceptedEnrollments->count() }} Accepted
                    </a>
                </div>
                @endif
                @else
                <div class="text-center py-5">
                    <i class="fas fa-check-circle fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Accepted Enrollments</h5>
                    <p class="text-muted">No students have been accepted yet.</p>
                </div>
                @endif
            </div>

            <!-- Pending Enrollments Tab -->
            <div class="tab-pane fade" id="pending" role="tabpanel">
                @if($pendingEnrollments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Student</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Course</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Enrolled</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingEnrollments->take(10) as $enrollment)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem;">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-bold" style="color: #111827;">{{ $enrollment->user->name }}</div>
                                            <div class="text-muted small">{{ $enrollment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</div>
                                    @if($enrollment->course->duration)
                                    <div class="text-muted small">
                                        <i class="fas fa-clock me-1"></i>{{ $enrollment->course->duration }}
                                    </div>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="text-muted small">
                                        <i class="fas fa-calendar-alt me-1"></i>{{ $enrollment->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">
                                        {{ $enrollment->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-sm btn-warning" style="border-radius: 6px;">
                                        <i class="fas fa-check me-1"></i>Review
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($pendingEnrollments->count() > 10)
                <div class="text-center mt-3">
                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-outline-warning" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>View All {{ $pendingEnrollments->count() }} Pending
                    </a>
                </div>
                @endif
                @else
                <div class="text-center py-5">
                    <i class="fas fa-clock fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Pending Enrollments</h5>
                    <p class="text-muted">All enrollment requests have been processed.</p>
                </div>
                @endif
            </div>

            <!-- Rejected Enrollments Tab -->
            <div class="tab-pane fade" id="rejected" role="tabpanel">
                @if($rejectedEnrollments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Student</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Course</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Rejected</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Notes</th>
                                <th style="font-weight: 600; color: #374151; border: none; padding: 1rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedEnrollments->take(10) as $enrollment)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem;">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-bold" style="color: #111827;">{{ $enrollment->user->name }}</div>
                                            <div class="text-muted small">{{ $enrollment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="fw-bold" style="color: #2563eb;">{{ $enrollment->course->title }}</div>
                                </td>
                                <td style="padding: 1rem;">
                                    <div class="text-muted small">
                                        <i class="fas fa-calendar-times me-1"></i>{{ $enrollment->updated_at->format('M d, Y') }}
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    @if($enrollment->notes)
                                        <div class="text-muted small" title="{{ $enrollment->notes }}">
                                            <i class="fas fa-sticky-note me-1"></i>{{ Str::limit($enrollment->notes, 40) }}
                                        </div>
                                    @else
                                        <span class="text-muted small">No notes</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($rejectedEnrollments->count() > 10)
                <div class="text-center mt-3">
                    <a href="{{ route('doctor.enrollments.index') }}" class="btn btn-outline-danger" style="border-radius: 8px;">
                        <i class="fas fa-arrow-right me-1"></i>View All {{ $rejectedEnrollments->count() }} Rejected
                    </a>
                </div>
                @endif
                @else
                <div class="text-center py-5">
                    <i class="fas fa-times-circle fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Rejected Enrollments</h5>
                    <p class="text-muted">No enrollment requests have been rejected.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }
    .nav-tabs .nav-link:hover {
        border-bottom-color: rgba(37, 99, 235, 0.3);
    }
    .nav-tabs .nav-link.active {
        border-bottom-color: currentColor;
        background: transparent;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }
</style>
@endsection