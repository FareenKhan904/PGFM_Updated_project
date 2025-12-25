@extends('layouts.student')

@section('title', 'My Profile - Student Dashboard')

@section('student-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user-circle me-2 text-primary"></i>My Profile</h2>
    <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">
        <i class="fas fa-edit me-2"></i>Edit Profile
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
    <!-- Profile Information Card -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-user me-2"></i>Profile Information</h4>
            </div>
            <div class="card-body">
                <!-- Profile Picture Display -->
                <div class="text-center mb-4">
                    <div class="position-relative d-inline-block">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #2563eb;">
                        @else
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; border: 4px solid #2563eb;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                    <p class="text-muted">Student</p>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong class="text-muted">Full Name:</strong>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-0">{{ $user->name }}</p>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong class="text-muted">Email Address:</strong>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-0">{{ $user->email }}</p>
                        @if($user->email_verified_at)
                        <small class="text-success"><i class="fas fa-check-circle me-1"></i>Verified</small>
                        @else
                        <small class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Not Verified</small>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong class="text-muted">Account Type:</strong>
                    </div>
                    <div class="col-md-8">
                        <span class="badge bg-primary">Student</span>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong class="text-muted">Member Since:</strong>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-0">{{ $user->created_at->format('F d, Y') }}</p>
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <strong class="text-muted">Last Updated:</strong>
                    </div>
                    <div class="col-md-8">
                        <p class="mb-0">{{ $user->updated_at->format('F d, Y') }}</p>
                        <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Statistics Card -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Account Statistics</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #2563eb;">
                    @else
                        <div class="display-4 text-primary mb-2">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    @endif
                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted mb-0">Student Account</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span><i class="fas fa-calendar-check me-2 text-primary"></i>Account Age</span>
                    <strong>{{ $user->created_at->diffInDays(now()) }} days</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span><i class="fas fa-shield-alt me-2 text-success"></i>Account Status</span>
                    <span class="badge bg-success">Active</span>
                </div>
                @if($user->email_verified_at)
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-check-circle me-2 text-info"></i>Email Status</span>
                    <span class="badge bg-info">Verified</span>
                </div>
                @else
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-exclamation-circle me-2 text-warning"></i>Email Status</span>
                    <span class="badge bg-warning">Unverified</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                    <a href="{{ route('courses') }}" class="btn btn-outline-info">
                        <i class="fas fa-graduation-cap me-2"></i>Browse Courses
                    </a>
                    <a href="{{ route('library.index') }}" class="btn btn-outline-success">
                        <i class="fas fa-book-open me-2"></i>Visit Library
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

