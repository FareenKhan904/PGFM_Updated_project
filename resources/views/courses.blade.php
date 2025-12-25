@extends('layouts.public')

@section('title', 'Courses - PGIFM')

@section('content')
<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Our Courses</h1>
                <p class="lead">Comprehensive exam preparation programs for MCPS Family Medicine & MRCGP INT South Asia</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Courses -->
<section class="py-5">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dynamic Courses from Database -->
        @if($courses && $courses->count() > 0)
            @foreach($courses as $course)
            <div class="card border-0 shadow-lg mb-5" id="course-{{ $course->id }}">
                <div class="card-body p-5">
                    <div class="text-primary mb-4">
                        <i class="fas {{ $course->icon_class ?? 'fa-graduation-cap' }} fa-4x"></i>
                    </div>
                    <h2 class="card-title mb-3">{{ $course->title }}</h2>
                    @if($course->subtitle)
                    <p class="text-muted lead mb-4">{{ $course->subtitle }}</p>
                    @endif
                    
                    @if($course->program_overview)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Program Overview</h5>
                        <p class="mb-3">{!! nl2br(e($course->program_overview)) !!}</p>
                        @if($course->awarding_body || $course->goal)
                        <ul class="list-unstyled">
                            @if($course->awarding_body)
                            <li class="mb-2"><i class="fas fa-building text-primary me-2"></i><strong>Awarding Body:</strong> {{ $course->awarding_body }}</li>
                            @endif
                            @if($course->goal)
                            <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i><strong>Goal:</strong> {{ $course->goal }}</li>
                            @endif
                        </ul>
                        @endif
                    </div>
                    @endif

                    @if($course->qualification_purpose)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Qualification and Purpose</h5>
                        <p class="mb-3">{!! nl2br(e($course->qualification_purpose)) !!}</p>
                        @if($course->awarding_body || $course->goal)
                        <ul class="list-unstyled">
                            @if($course->awarding_body)
                            <li class="mb-2"><i class="fas fa-award text-primary me-2"></i><strong>International Membership:</strong> {{ $course->awarding_body }}</li>
                            @endif
                            @if($course->goal)
                            <li class="mb-2"><i class="fas fa-globe-asia text-primary me-2"></i><strong>Local Focus:</strong> {{ $course->goal }}</li>
                            @endif
                        </ul>
                        @endif
                    </div>
                    @endif

                    @if($course->examination_components || $course->examination_structure || $course->examination_details)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-clipboard-list text-primary me-2"></i>Examination @if($course->examination_structure || $course->examination_details)Structure @else Components @endif</h5>
                        @if($course->examination_components)
                            @if(is_array($course->examination_components))
                                <ul class="list-unstyled">
                                    @foreach($course->examination_components as $component)
                                    <li class="mb-2"><i class="fas fa-file-alt text-success me-2"></i><strong>{{ $component }}</strong></li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="mb-2">{!! nl2br(e($course->examination_components)) !!}</p>
                            @endif
                        @endif
                        @if($course->examination_structure)
                        <p class="mb-2">{!! nl2br(e($course->examination_structure)) !!}</p>
                        @endif
                        @if($course->examination_details)
                        <ul class="list-unstyled">
                            @if(is_array($course->examination_details))
                                @foreach($course->examination_details as $detail)
                                <li class="mb-2"><i class="fas fa-clock text-success me-2"></i>{{ $detail }}</li>
                                @endforeach
                            @else
                                <li class="mb-2">{!! nl2br(e($course->examination_details)) !!}</li>
                            @endif
                        </ul>
                        @endif
                    </div>
                    @endif

                    @if($course->eligibility_criteria || $course->eligibility_attempts)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-user-check text-primary me-2"></i>Eligibility @if($course->eligibility_attempts) & Attempts @else Criteria @endif</h5>
                        @if($course->eligibility_criteria)
                            @if(is_array($course->eligibility_criteria))
                                <ul class="list-unstyled">
                                    @foreach($course->eligibility_criteria as $criterion)
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>{{ $criterion }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="mb-2">{!! nl2br(e($course->eligibility_criteria)) !!}</p>
                            @endif
                        @endif
                        @if($course->eligibility_attempts)
                        <p class="mb-0 text-muted small"><i class="fas fa-info-circle me-1"></i>{!! nl2br(e($course->eligibility_attempts)) !!}</p>
                        @endif
                    </div>
                    @endif

                    @if($course->mandatory_workshops)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-certificate text-primary me-2"></i>Mandatory Workshops</h5>
                        <p class="mb-2">Doctors are required to attend mandatory workshops as a pre-requisite for the final examination. These may include:</p>
                        @if(is_array($course->mandatory_workshops))
                            <ul class="list-unstyled">
                                @foreach($course->mandatory_workshops as $workshop)
                                <li class="mb-2"><i class="fas fa-tools text-warning me-2"></i>{{ $workshop }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{!! nl2br(e($course->mandatory_workshops)) !!}</p>
                        @endif
                    </div>
                    @endif

                    @if($course->course_modules)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-book-medical text-primary me-2"></i>Course Modules</h5>
                        <p class="mb-3">This comprehensive course covers the following medical specialties:</p>
                        @if(is_array($course->course_modules))
                            <div class="row g-3">
                                @foreach($course->course_modules as $module)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-primary h-100 shadow-sm">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-0"><i class="fas fa-heartbeat text-primary me-2"></i>{{ $module }}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p>{!! nl2br(e($course->course_modules)) !!}</p>
                        @endif
                    </div>
                    @endif

                    @if($course->skills_assessed)
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-tasks text-primary me-2"></i>Skills Assessed</h5>
                        <p class="mb-2">The stations in the exam are scenario-based and cover a wide range of skills essential for a family physician, including:</p>
                        @if(is_array($course->skills_assessed))
                            <ul class="list-unstyled">
                                @foreach($course->skills_assessed as $skill)
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>{{ $skill }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{!! nl2br(e($course->skills_assessed)) !!}</p>
                        @endif
                    </div>
                    @endif

                    @if($course->whats_included)
                    <div class="mb-4">
                        <h6 class="text-primary mb-2"><i class="fas fa-check-circle me-2"></i>What's Included:</h6>
                        @if(is_array($course->whats_included))
                            <ul class="list-unstyled mb-0">
                                @foreach($course->whats_included as $item)
                                <li class="mb-1"><i class="fas fa-video text-success me-2"></i>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{!! nl2br(e($course->whats_included)) !!}</p>
                        @endif
                    </div>
                    @endif

                    <!-- Pricing Information -->
                    @if($course->fee || $course->early_bird_fee)
                    <div class="mb-4">
                        <div class="d-flex gap-3 align-items-center">
                            @if($course->fee)
                            <div>
                                <strong class="text-primary">Standard Fee:</strong> PKR {{ number_format($course->fee, 2) }}
                            </div>
                            @endif
                            @if($course->early_bird_fee)
                            <div>
                                <strong class="text-success">Early Bird:</strong> PKR {{ number_format($course->early_bird_fee, 2) }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Course Details Summary -->
                    <div class="row mb-4">
                        @if($course->duration)
                        <div class="col-md-6 mb-2">
                            <p class="mb-1 small">
                                <i class="fas fa-clock me-2" style="color: #10b981;"></i>
                                <strong>Duration:</strong> {{ $course->duration }}
                            </p>
                        </div>
                        @endif
                        @if($course->fee)
                        <div class="col-md-6 mb-2">
                            <p class="mb-1 small">
                                <i class="fas fa-money-bill-wave me-2" style="color: #f59e0b;"></i>
                                <strong>Fee:</strong> PKR {{ number_format($course->fee, 2) }}
                            </p>
                        </div>
                        @elseif(!$course->fee && !$course->early_bird_fee)
                        <div class="col-md-6 mb-2">
                            <p class="mb-1 small text-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Free Course</strong>
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Enrollment Button -->
                    <div class="mt-4">
                        @auth
                            @if(Auth::user()->isStudent())
                                <form action="{{ route('enroll.by-title') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="course_title" value="{{ $course->title }}">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Enroll Now
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact for Enrollment</a>
                            @endif
                        @else
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Signup to Enroll
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <div class="text-center py-5">
            <i class="fas fa-graduation-cap fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">No Courses Available</h3>
            <p class="text-muted">Check back soon for new courses!</p>
        </div>
        @endif

        <div class="text-center mt-5">
            @auth
                @if(Auth::user()->isStudent())
                    <p class="text-muted mb-3">View your enrolled courses in your dashboard</p>
                    <a href="{{ route('student.courses.index') }}" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-graduation-cap me-2"></i>My Courses
                    </a>
                @else
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">Contact for Enrollment</a>
                @endif
            @else
            <a href="{{ route('register') }}" class="btn btn-success btn-lg px-5">
                <i class="fas fa-user-plus me-2"></i>Signup to Enroll
            </a>
            @endauth
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to section if hash is present in URL
    const hash = window.location.hash;
    if (hash) {
        setTimeout(function() {
            const element = document.querySelector(hash);
            if (element) {
                const offset = 80; // Offset for fixed navbar
                const elementPosition = element.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }, 100);
    }
});
</script>
@endsection
