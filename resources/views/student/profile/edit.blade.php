@extends('layouts.student')

@section('title', 'Edit Profile - Student Dashboard')

@section('student-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit me-2 text-primary"></i>Edit Profile</h2>
    <a href="{{ route('student.profile.show') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Profile
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Update Profile Information</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Picture Upload -->
                    <div class="mb-4 text-center">
                        <label class="form-label d-block">Profile Picture</label>
                        <div class="position-relative d-inline-block mb-3">
                            @if($user->profile_picture)
                                <img id="profilePreview" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #2563eb; cursor: pointer;" onclick="document.getElementById('profile_picture').click()">
                            @else
                                <div id="profilePreview" class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; border: 3px solid #2563eb; cursor: pointer;" onclick="document.getElementById('profile_picture').click()">
                                    <i class="fas fa-user fa-3x text-white"></i>
                                </div>
                            @endif
                        </div>
                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture" accept="image/*" style="display: none;" onchange="previewProfilePicture(this)">
                        <div class="d-flex justify-content-center gap-2">
                            <label for="profile_picture" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-upload me-1"></i>Change Picture
                            </label>
                            @if($user->profile_picture)
                            <form action="{{ route('student.profile.removePicture') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove your profile picture?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash me-1"></i>Remove
                                </button>
                            </form>
                            @endif
                        </div>
                        <small class="form-text text-muted d-block mt-2">Recommended size: 300x300px. Max file size: 2MB</small>
                        @error('profile_picture')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr class="my-4">

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($user->email_verified_at)
                        <small class="form-text text-success"><i class="fas fa-check-circle me-1"></i>Email is verified</small>
                        @else
                        <small class="form-text text-warning"><i class="fas fa-exclamation-circle me-1"></i>Email is not verified</small>
                        @endif
                    </div>

                    <hr class="my-4">

                    <!-- Password Change Section -->
                    <h5 class="mb-3"><i class="fas fa-lock me-2"></i>Change Password</h5>
                    <p class="text-muted small mb-3">Leave blank if you don't want to change your password.</p>

                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Required only if you want to change your password</small>
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="8">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Minimum 8 characters</small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" minlength="8">
                        <small class="form-text text-muted">Re-enter your new password</small>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('student.profile.show') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewProfilePicture(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('profilePreview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Profile Picture" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #2563eb;">`;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

</script>
@endsection

