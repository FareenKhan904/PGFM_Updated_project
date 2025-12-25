@extends('layouts.public')

@section('title', 'Student Testimonials - PGIFM')

@section('content')
<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%);">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Student Testimonials</h1>
                <p class="lead">Hear from our successful students who passed their exams</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background: linear-gradient(to bottom, #ffffff 0%, #f8fafc 100%);">
    <div class="container">
        <div class="row g-4">
            <!-- Testimonial 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"I cleared on my first attempt… highly recommended!"</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 fw-bold">MRCGP INT Candidate</p>
                                <p class="mb-0 text-muted small">Pakistan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"Dr Sahar's notes alone helped me pass."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 fw-bold">MRCGP INT Candidate</p>
                                <p class="mb-0 text-muted small">Dubai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"Her motivation made all the difference."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 fw-bold">Family Medicine Trainee</p>
                                <p class="mb-0 text-muted small">Saudi Arabia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"She is supportive and approachable."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 fw-bold">MCPS Trainee</p>
                                <p class="mb-0 text-muted small">Pakistan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"Fantastic interaction and clear sessions."</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 fw-bold">MRCGP INT Trainee</p>
                                <p class="mb-0 text-muted small">Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Stats Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-lg bg-primary text-white">
                    <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                        <i class="fas fa-trophy fa-4x mb-3"></i>
                        <h3 class="mb-3">99% Success Rate</h3>
                        <p class="mb-0">Join hundreds of successful students who have passed their exams with Dr. Sahar Aslam</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-5">
            <h3 class="mb-4">Ready to Join Our Success Stories?</h3>
            <p class="lead text-muted mb-4">Start your journey towards exam success today</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">Get Started</a>
                <a href="{{ route('courses') }}" class="btn btn-outline-primary btn-lg px-5">View Courses</a>
            </div>
        </div>
    </div>
</section>
@endsection

