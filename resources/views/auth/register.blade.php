@extends('layouts.public')

@section('title', 'Register - PGIFM')

@section('content')
<section class="py-5" style="background: linear-gradient(to bottom, #f8fafc 0%, #ffffff 100%); min-height: calc(100vh - 200px);">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                    <!-- Header with Gradient -->
                    <div class="card-header border-0 text-white text-center py-4" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%);">
                        <div class="mb-3">
                            <img src="{{ asset('images/logo1.png') }}" alt="PGIFM Logo" style="height: 75px; width: auto; filter: brightness(0) invert(1);">
                        </div>
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
                        </h3>
                        <p class="mb-0 opacity-75 mt-2">Join PGIFM today</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold" style="color: #2563eb;">
                                    <i class="fas fa-user me-2"></i>{{ __('Name') }}
                                </label>
                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem;">
                                
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold" style="color: #2563eb;">
                                    <i class="fas fa-envelope me-2"></i>{{ __('Email Address') }}
                                </label>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem;">
                                
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold" style="color: #2563eb;">
                                    <i class="fas fa-lock me-2"></i>{{ __('Password') }}
                                </label>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem;">
                                
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-semibold" style="color: #2563eb;">
                                    <i class="fas fa-lock me-2"></i>{{ __('Confirm Password') }}
                                </label>
                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem;">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-lg text-white fw-semibold" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 10px; padding: 0.75rem;">
                                    <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
                                </button>
                            </div>

                            <hr class="my-4" style="border-color: #e5e7eb;">

                            <div class="text-center">
                                <p class="mb-0 text-muted">Already have an account?</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-primary mt-2" style="border-radius: 10px; border-color: #2563eb; color: #2563eb;">
                                    <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login Now') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.form-control:focus {
    border-color: #2563eb !important;
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25) !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
}
</style>
@endsection
