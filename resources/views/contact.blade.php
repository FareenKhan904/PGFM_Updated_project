@extends('layouts.public')

@section('title', 'Contact & Enrollment - PGIFM')

@section('content')
<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%);">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Contact & Enrollment</h1>
                <p class="lead">Get in touch with us to start your exam preparation journey</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left Side - Contact Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body p-5">
                        <h2 class="mb-4" style="color: #2563eb;">Send us a Message</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span style="color: #2563eb;">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span style="color: #2563eb;">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject <span style="color: #2563eb;">*</span></label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message <span style="color: #2563eb;">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-lg w-100 text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none;">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side - Contact Information -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body p-5">
                        <h2 class="mb-4" style="color: #2563eb;">Contact Information</h2>
                        
                        <!-- Email -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-envelope fa-2x" style="color: #2563eb;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-2">Email</h5>
                                    <p class="mb-0">
                                        <a href="mailto:saharaslam@gmail.com" class="text-decoration-none">
                                            saharaslam@gmail.com
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fab fa-whatsapp fa-2x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-2">WhatsApp</h5>
                                    <p class="mb-1">
                                        <a href="https://wa.me/923333451936" target="_blank" class="text-decoration-none">
                                            0333-3451936
                                        </a>
                                    </p>
                                    <p class="mb-0">
                                        <a href="https://wa.me/923335652360" target="_blank" class="text-decoration-none">
                                            0333-5652360
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fab fa-instagram fa-2x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-2">Instagram</h5>
                                    <p class="mb-0">
                                        <a href="https://instagram.com/its.saharaslam" target="_blank" class="text-decoration-none">
                                            @its.saharaslam
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- YouTube -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fab fa-youtube fa-2x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-2">YouTube</h5>
                                    <p class="mb-0">
                                        <a href="https://youtube.com/@drsaharaslam" target="_blank" class="text-decoration-none">
                                            Dr Sahar Aslam — Exam Mentor & Educator
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-map-marker-alt fa-2x" style="color: #2563eb;"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-2">Location</h5>
                                    <p class="mb-0">Online based — Pakistan | South Asia | Global Students Welcome</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollment Info -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="alert border-0 shadow-sm" style="background: linear-gradient(to right, rgba(37, 99, 235, 0.1), rgba(79, 70, 229, 0.1)); border-left: 4px solid #2563eb !important;">
                    <h5 class="alert-heading" style="color: #2563eb;"><i class="fas fa-info-circle me-2" style="color: #2563eb;"></i>Enrollment Information</h5>
                    <p class="mb-2">To enroll in any of our courses or mentorship programs, please contact us through any of the channels above.</p>
                    <p class="mb-0">We welcome students from all over the world and offer flexible scheduling to accommodate different time zones.</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="text-center">
                    <h4 class="mb-4">Ready to Get Started?</h4>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-lg px-4 text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none;">
                            <i class="fas fa-user-plus me-2"></i>Register Now
                        </a>
                        <a href="{{ route('courses') }}" class="btn btn-outline-primary btn-lg px-4" style="border-color: #2563eb; color: #2563eb;">
                            <i class="fas fa-book me-2"></i>View Courses
                        </a>
                        <a href="{{ route('mentorship') }}" class="btn btn-outline-primary btn-lg px-4" style="border-color: #2563eb; color: #2563eb;">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Mentorship Program
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

                                                                                