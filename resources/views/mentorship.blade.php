@extends('layouts.public')

@section('title', 'Mentorship Program - PGIFM')

@section('content')
<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%);">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Mentorship Program</h1>
                <p class="lead">Personalised one-to-one mentoring from Dr. Sahar Aslam</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Overview -->
                <div class="card border-0 shadow-lg mb-5">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <i class="fas fa-user-md fa-5x mb-4" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                            <h2 class="mb-3">Personalised Mentorship</h2>
                            <p class="lead text-muted">Get dedicated support tailored to your learning needs</p>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-clipboard-list fa-2x" style="color: #2563eb;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>Structured Study Plans</h5>
                                        <p class="text-muted mb-0">Customized learning paths designed for your exam timeline and goals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-comments fa-2x" style="color: #2563eb;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>Station Feedback</h5>
                                        <p class="text-muted mb-0">Detailed feedback on OSCE stations and practice scenarios</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-chart-line fa-2x" style="color: #2563eb;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>Progress Tracking</h5>
                                        <p class="text-muted mb-0">Monitor your improvement with regular assessments and reviews</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-book-medical fa-2x" style="color: #2563eb;"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>Guideline-Based Learning</h5>
                                        <p class="text-muted mb-0">Based on NICE and CPSP guidelines for accurate exam preparation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Why Join Section -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-5">Why Join Our Mentorship Program?</h2>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-4 bg-light rounded">
                                    <div class="display-4 mb-2 fw-bold" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">99%</div>
                                    <p class="mb-0 fw-bold">Success Rate</p>
                                    <p class="text-muted small">Proven track record of student success</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-4 bg-light rounded">
                                    <i class="fas fa-check-circle fa-3x mb-2" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                    <p class="mb-0 fw-bold">Evidence-Based</p>
                                    <p class="text-muted small">Materials backed by latest research</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-4 bg-light rounded">
                                    <i class="fas fa-users fa-3x mb-2" style="color: #2563eb;"></i>
                                    <p class="mb-0 fw-bold">Small Groups</p>
                                    <p class="text-muted small">Personalized attention guaranteed</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="text-center p-4 bg-light rounded">
                                    <i class="fas fa-globe fa-3x mb-2" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                    <p class="mb-0 fw-bold">Updated Guidelines</p>
                                    <p class="text-muted small">International standards 2024-25</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- What's Included -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-5">
                        <h3 class="mb-4" style="color: #2563eb;">What's Included in Your Mentorship</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>One-on-one sessions with Dr. Sahar Aslam</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>Personalized study schedule</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>Regular progress assessments</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>Detailed feedback on practice exams</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>OSCE station practice and feedback</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>Access to updated study materials</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>Guidance on exam strategies</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2" style="color: #2563eb;"></i>Ongoing support throughout your journey</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center">
                    <h3 class="mb-4">Ready to Start Your Mentorship Journey?</h3>
                    <p class="lead text-muted mb-4">Get personalized guidance from an expert with a proven track record</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('contact') }}" class="btn btn-lg px-5 text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none;">Contact for Mentorship</a>
                        <a href="{{ route('courses') }}" class="btn btn-outline-primary btn-lg px-5" style="border-color: #2563eb; color: #2563eb;">View Courses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

