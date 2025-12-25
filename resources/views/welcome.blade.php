@extends('layouts.public')

@section('title', 'Home - PGIFM | Postgraduate Family Institute of Medicine Exam Prep')

@section('content')
<!-- Image Slider Section -->
@if($sliderImages && $sliderImages->count() > 0)
<section class="mb-0 position-relative" style="overflow: hidden;">
    <div id="welcomeSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="false" data-bs-wrap="true">
        <div class="carousel-indicators">
            @foreach($sliderImages as $index => $slider)
            <button type="button" data-bs-target="#welcomeSlider" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($sliderImages as $index => $slider)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="slider-image" style="height: 550px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.5) 0%, rgba(79, 70, 229, 0.5) 50%, rgba(124, 58, 237, 0.5) 100%), url('{{ asset('storage/' . $slider->image_path) }}') center center no-repeat; background-size: cover; background-position: center; position: relative;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);"></div>
                    <div class="container h-100 d-flex align-items-center position-relative">
                        <div class="text-white px-4 px-md-5" style="animation: fadeInUp 0.8s ease-out;">
                            @if($slider->title)
                            <h1 class="display-4 fw-bold mb-3" style="text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4); letter-spacing: -0.5px;">{{ $slider->title }}</h1>
                            @endif
                            @if($slider->description)
                            <p class="lead mb-4" style="text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3); font-size: 1.25rem;">{{ $slider->description }}</p>
                            @endif
                            @if($slider->button_text && $slider->button_link)
                            <a href="{{ $slider->button_link }}" class="btn btn-light btn-lg px-5 shadow-lg" style="border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-arrow-right me-2"></i>{{ $slider->button_text }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#welcomeSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#welcomeSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
@endif

<!-- About Preview Section -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%); overflow: hidden;">
    <div class="position-absolute top-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 80% 20%, rgba(37, 99, 235, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 20% 80%, rgba(124, 58, 237, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container position-relative">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="pe-lg-4">
                    <h2 class="display-4 fw-bold mb-4" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">About Dr. Sahar Aslam</h2>
                    <h4 class="mb-3 fw-semibold" style="color: #2563eb;">Specialist Family Physician</h4>
                    <p class="lead mb-4 fw-semibold" style="color: #4b5563;"><strong>MCPS (Pakistan) | MRCGP INT (South Asia)</strong></p>
                    <ul class="list-unstyled mb-4" style="line-height: 2;">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle me-3 mt-1" style="color: #2563eb; font-size: 1.2rem;"></i>
                            <span style="font-size: 1.05rem;">Cleared MRCGP INT on the first attempt</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle me-3 mt-1" style="color: #2563eb; font-size: 1.2rem;"></i>
                            <span style="font-size: 1.05rem;">Taught students across Dubai, Saudi Arabia, Sri Lanka, Bangladesh, and Pakistan</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle me-3 mt-1" style="color: #2563eb; font-size: 1.2rem;"></i>
                            <span style="font-size: 1.05rem;">99% passing success rate for MCPS & MRCGP INT students</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle me-3 mt-1" style="color: #2563eb; font-size: 1.2rem;"></i>
                            <span style="font-size: 1.05rem;">Incorporates updated guidelines: NICE, WHO, RCOG, ADA, BTS/SIGN</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle me-3 mt-1" style="color: #2563eb; font-size: 1.2rem;"></i>
                            <span style="font-size: 1.05rem;">Focuses on clinical reasoning, communication skills, and exam-based teaching</span>
                        </li>
                    </ul>
                    <a href="{{ route('about') }}" class="btn btn-lg mt-3 text-white shadow-lg" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; padding: 0.875rem 2.5rem; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">
                        <i class="fas fa-arrow-right me-2"></i>Learn More
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 glass-card h-100" style="border-radius: 24px; overflow: hidden;">
                    <div class="card-body p-4">
                        <h3 class="mb-4 fw-bold text-center" style="color: #2563eb; font-size: 1.5rem;">Why Choose PGIFM?</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="text-center p-3 glass-card-dark h-100" style="border-radius: 16px; transition: all 0.3s ease; position: relative; overflow: hidden;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                                    <div class="position-relative">
                                        <div class="mb-2 fw-bold" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 2.5rem; line-height: 1;">99%</div>
                                        <p class="mb-0 fw-semibold" style="color: #4b5563; font-size: 0.95rem;">Success Rate</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center p-3 glass-card-dark h-100" style="border-radius: 16px; transition: all 0.3s ease; position: relative; overflow: hidden;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                                    <div class="position-relative">
                                        <div class="mb-2 fw-bold" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 2.5rem; line-height: 1;">1st</div>
                                        <p class="mb-0 fw-semibold" style="color: #4b5563; font-size: 0.95rem;">Attempt Pass</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center p-3 glass-card-dark h-100" style="border-radius: 16px; transition: all 0.3s ease; position: relative; overflow: hidden;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                                    <div class="position-relative">
                                        <div class="mb-2 fw-bold" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 2.5rem; line-height: 1;">5+</div>
                                        <p class="mb-0 fw-semibold" style="color: #4b5563; font-size: 0.95rem;">Countries</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center p-3 glass-card-dark h-100" style="border-radius: 16px; transition: all 0.3s ease; position: relative; overflow: hidden;">
                                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                                    <div class="position-relative">
                                        <div class="mb-2 fw-bold" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 2.5rem; line-height: 1;">2020-25</div>
                                        <p class="mb-0 fw-semibold" style="color: #4b5563; font-size: 0.95rem;">Updated Guidelines</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Platform Features Section -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f8fafc 100%); overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 20% 30%, rgba(37, 99, 235, 0.04) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 80% 70%, rgba(124, 58, 237, 0.04) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container position-relative">
    <div class="container">
        <div class="text-center mb-5 px-3">
            <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">Platform Features</h2>
            <p class="lead text-muted mb-0" style="font-size: 1.25rem;">Everything you need for successful exam preparation</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card platform-feature-card h-100 border-0 shadow-sm text-center p-5 glass-card" style="border-radius: 24px;">
                    <div class="mb-4 feature-icon">
                        <i class="fas fa-video fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold" style="color: #2563eb; font-size: 1.5rem;">Live & Recorded Classes</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem;">Attend live interactive sessions or watch recorded lectures at your own pace. All classes are available for review.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card platform-feature-card h-100 border-0 shadow-sm text-center p-5 glass-card" style="border-radius: 24px;">
                    <div class="mb-4 feature-icon">
                        <i class="fas fa-book-reader fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold" style="color: #2563eb; font-size: 1.5rem;">Comprehensive Library</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem;">Access a vast collection of books, articles, research papers, and study materials curated by experts.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card platform-feature-card h-100 border-0 shadow-sm text-center p-5 glass-card" style="border-radius: 24px;">
                    <div class="mb-4 feature-icon">
                        <i class="fas fa-clipboard-check fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold" style="color: #2563eb; font-size: 1.5rem;">Practice MCQs</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem;">Test your knowledge with extensive MCQ banks covering all topics relevant to MCPS and MRCGP INT exams.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card platform-feature-card h-100 border-0 shadow-sm text-center p-5 glass-card" style="border-radius: 24px;">
                    <div class="mb-4 feature-icon">
                        <i class="fas fa-comments fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold" style="color: #2563eb; font-size: 1.5rem;">Expert Feedback</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem;">Receive personalized feedback on your performance with detailed explanations and improvement suggestions.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card platform-feature-card h-100 border-0 shadow-sm text-center p-5 glass-card" style="border-radius: 24px;">
                    <div class="mb-4 feature-icon">
                        <i class="fas fa-user-graduate fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold" style="color: #2563eb; font-size: 1.5rem;">Mentorship Program</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem;">Get one-on-one guidance from experienced faculty members to help you achieve your exam goals.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card platform-feature-card h-100 border-0 shadow-sm text-center p-5 glass-card" style="border-radius: 24px;">
                    <div class="mb-4 feature-icon">
                        <i class="fas fa-mobile-alt fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold" style="color: #2563eb; font-size: 1.5rem;">Mobile Friendly</h4>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem;">Study anywhere, anytime with our responsive platform that works seamlessly on all devices.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%); overflow: hidden;">
    <div class="position-absolute top-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 90% 10%, rgba(37, 99, 235, 0.03) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 10% 90%, rgba(124, 58, 237, 0.03) 0%, transparent 60%); pointer-events: none;"></div>
    <div class="container position-relative">
    <div class="container">
        <div class="text-center mb-5 px-3">
            <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">Our Courses</h2>
            <p class="lead text-muted mb-0" style="font-size: 1.25rem;">Comprehensive exam preparation programs designed for success</p>
        </div>
        @if($courses->count() > 0)
        <div class="row g-4 justify-content-center">
            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-lg border-0 glass-card" style="border-radius: 24px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-body p-5">
                        <div class="mb-4 text-center">
                            <i class="fas {{ $course->icon_class ?? 'fa-graduation-cap' }} fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                        </div>
                        <h4 class="card-title mb-3 fw-bold text-center" style="color: #2563eb; font-size: 1.5rem; line-height: 1.3;">{{ $course->title }}</h4>
                        @if($course->description)
                        <p class="text-muted mb-4 text-center" style="line-height: 1.7; font-size: 1rem;">{{ Str::limit($course->description, 120) }}</p>
                        @endif
                        <ul class="list-unstyled mb-4">
                            @if($course->duration)
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-clock me-3" style="color: #2563eb; font-size: 1.1rem;"></i>
                                <span><strong>Duration:</strong> {{ $course->duration }}</span>
                            </li>
                            @endif
                            @if($course->fee)
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-rupee-sign me-3" style="color: #2563eb; font-size: 1.1rem;"></i>
                                <span><strong>Fee:</strong> PKR {{ number_format($course->fee, 2) }}</span>
                            </li>
                            @endif
                        </ul>
                        <div class="text-center">
                            <button type="button" class="btn text-white shadow-lg w-100" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 12px; padding: 0.75rem; font-weight: 600;" data-bs-toggle="modal" data-bs-target="#courseModal{{ $course->id }}">
                                <i class="fas fa-info-circle me-2"></i>Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-graduation-cap fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                        </div>
                        <h4 class="card-title mb-3" style="color: #2563eb;">MCPS Family Medicine</h4>
                        <p class="text-muted mb-3">Exam Preparation Course</p>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>8-10 weeks duration</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>Online live + recorded classes</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>Lectures, MCQs, feedback sessions</li>
                        </ul>
                        <a href="{{ route('courses') }}#mcps-family-medicine" class="btn text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-certificate fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                        </div>
                        <h4 class="card-title mb-3" style="color: #2563eb;">MRCGP INT South Asia</h4>
                        <p class="text-muted mb-3">AKT & OSCE Preparation</p>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>12 weeks duration</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>Live small-group sessions</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>AKT & OSCE focus</li>
                        </ul>
                        <a href="{{ route('courses') }}#mrcgp-int" class="btn text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-stethoscope fa-3x" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                        </div>
                        <h4 class="card-title mb-3" style="color: #2563eb;">MCPS Family Medicine TOACS</h4>
                        <p class="text-muted mb-3">Task-Oriented Assessment of Clinical Skills</p>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>12 stations assessment</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>History taking & examination</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>Communication & counselling skills</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: #2563eb;"></i>60% passing requirement</li>
                        </ul>
                        <a href="{{ route('courses') }}#mcps-toacs" class="btn text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="text-center mt-5">
            <a href="{{ route('courses') }}" class="btn btn-lg text-white shadow-lg" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; padding: 0.875rem 2.5rem; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">
                <i class="fas fa-arrow-right me-2"></i>View All Courses
            </a>
        </div>
    </div>
</section>

<!-- Course Detail Modals -->
@if($courses->count() > 0)
@foreach($courses as $course)
<div class="modal fade" id="courseModal{{ $course->id }}" tabindex="-1" aria-labelledby="courseModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <!-- Header with Gradient Background -->
            <div class="modal-header text-white border-0" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%); padding: 1.5rem;">
                <div class="d-flex align-items-center w-100">
                    <div class="me-3">
                        <i class="fas fa-graduation-cap fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title mb-0 fw-bold" id="courseModalLabel{{ $course->id }}">
                            {{ $course->title }}
                        </h5>
                        <small class="opacity-75">Course Details</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.9;"></button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="modal-body p-4">
                @if($course->description)
                <div class="mb-4">
                    <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Description</h6>
                    <p class="text-muted" style="line-height: 1.8;">{{ $course->description }}</p>
                </div>
                @endif
                
                <div class="row g-3 mb-4">
                    @if($course->duration)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3" style="background: #f8fafc; border-radius: 8px;">
                            <i class="fas fa-clock fa-2x me-3" style="color: #2563eb;"></i>
                            <div>
                                <small class="text-muted d-block">Duration</small>
                                <strong style="color: #2563eb;">{{ $course->duration }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($course->fee)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3" style="background: #f8fafc; border-radius: 8px;">
                            <i class="fas fa-rupee-sign fa-2x me-3" style="color: #2563eb;"></i>
                            <div>
                                <small class="text-muted d-block">Course Fee</small>
                                <strong style="color: #2563eb;">PKR {{ number_format($course->fee, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @auth
                    @if(in_array($course->id, $enrollments ?? []))
                    <div class="alert alert-success border-0 mb-0" style="background: linear-gradient(to right, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border-left: 4px solid #10b981 !important;">
                        <i class="fas fa-check-circle me-2" style="color: #10b981;"></i>
                        <strong style="color: #10b981;">You are enrolled!</strong>
                        <p class="mb-0 mt-2">You have successfully enrolled in this course. Check your dashboard for course materials and updates.</p>
                    </div>
                    @else
                    <div class="alert alert-info border-0 mb-0" style="background: linear-gradient(to right, rgba(37, 99, 235, 0.1), rgba(79, 70, 229, 0.1)); border-left: 4px solid #2563eb !important;">
                        <i class="fas fa-lightbulb me-2" style="color: #2563eb;"></i>
                        <strong style="color: #2563eb;">Ready to enroll?</strong>
                        <p class="mb-0 mt-2">Click the "Enroll Now" button below to enroll in this course.</p>
                    </div>
                    @endif
                @else
                <div class="alert alert-warning border-0 mb-0" style="background: linear-gradient(to right, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1)); border-left: 4px solid #f59e0b !important;">
                    <i class="fas fa-exclamation-circle me-2" style="color: #f59e0b;"></i>
                    <strong style="color: #f59e0b;">Signup Required</strong>
                    <p class="mb-0 mt-2">You need to create an account to enroll in this course. <a href="{{ route('register') }}" class="fw-bold" style="color: #f59e0b;">Sign up now</a> to get started!</p>
                </div>
                @endauth
            </div>
            
            <!-- Footer -->
            <div class="modal-footer border-0" style="background: linear-gradient(to right, #f8fafc 0%, #ffffff 100%); padding: 1.25rem 1.5rem;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #cbd5e1;">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                @auth
                    @if(in_array($course->id, $enrollments ?? []))
                    <button type="button" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.5rem 1.5rem;" disabled>
                        <i class="fas fa-check-circle me-2"></i>Already Enrolled
                    </button>
                    @else
                    <form action="{{ route('enroll.store', $course->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-user-plus me-2"></i>Enroll Now
                        </button>
                    </form>
                    @endif
                @else
                <a href="{{ route('register') }}" class="btn text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; padding: 0.5rem 1.5rem;">
                    <i class="fas fa-user-plus me-2"></i>Signup to Enroll
                </a>
                @endauth
                <a href="{{ route('courses') }}" class="btn text-white" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none; padding: 0.5rem 1.5rem;">
                    <i class="fas fa-book me-2"></i>View All Courses
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

<!-- Gallery Section -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f8fafc 100%); overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 15% 25%, rgba(37, 99, 235, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 85% 75%, rgba(124, 58, 237, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container position-relative">
        <div class="text-center mb-5 px-3">
            <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">Gallery</h2>
            <p class="lead text-muted mb-0" style="font-size: 1.25rem;">Moments from our courses, events, and student achievements</p>
        </div>
        @if(isset($galleries) && $galleries->count() > 0)
        <div class="row g-4">
            @foreach($galleries as $gallery)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 gallery-card glass-card" style="border-radius: 20px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="position-relative" style="overflow: hidden;">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title ?? 'Gallery Image' }}" style="height: 300px; object-fit: cover; transition: transform 0.3s ease;">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(37, 99, 235, 0.8); opacity: 0; transition: opacity 0.3s ease;">
                            <div class="text-white text-center p-3">
                                @if($gallery->title)
                                <h5 class="fw-bold mb-2">{{ $gallery->title }}</h5>
                                @endif
                                @if($gallery->description)
                                <p class="mb-0">{{ Str::limit($gallery->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($gallery->title || $gallery->description)
                    <div class="card-body p-3">
                        @if($gallery->title)
                        <h6 class="card-title mb-2" style="color: #2563eb;">{{ $gallery->title }}</h6>
                        @endif
                        @if($gallery->description)
                        <p class="card-text text-muted small mb-0">{{ Str::limit($gallery->description, 80) }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Gallery coming soon</h5>
                        <p class="text-muted">Check back later for photos from our events and courses.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- News Section -->
<section id="news-section" class="py-5 position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f8fafc 100%); overflow: hidden;">
    <div class="position-absolute top-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 90% 20%, rgba(37, 99, 235, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 10% 80%, rgba(124, 58, 237, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container position-relative">
        <div class="text-center mb-5 px-3">
            <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">Latest News & Updates</h2>
            <p class="lead text-muted mb-0" style="font-size: 1.25rem;">Stay informed with the latest announcements and updates</p>
        </div>
        @if($news->count() > 0)
        <div class="row g-4">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 glass-card" style="border-radius: 20px; transition: all 0.3s ease; overflow: hidden;">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top d-flex align-items-center justify-content-center glass-card-dark" style="height: 200px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.3) 0%, rgba(79, 70, 229, 0.3) 100%);">
                        <i class="fas fa-newspaper fa-4x text-white" style="opacity: 0.5;"></i>
                    </div>
                    @endif
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-2">
                            <small class="badge rounded-pill" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); color: white; padding: 0.25rem 0.75rem;">
                                <i class="fas fa-calendar-alt me-1"></i>{{ $item->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        <h4 class="card-title mb-3" style="color: #2563eb;">{{ $item->title }}</h4>
                        <p class="card-text text-muted">{{ Str::limit($item->content, 120) }}</p>
                        <a href="#" class="btn btn-sm text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
                        <i class="fas fa-newspaper fa-4x text-white" style="opacity: 0.3;"></i>
                    </div>
                    <div class="card-body p-4">
                        <small class="badge rounded-pill d-block mb-2" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); color: white; padding: 0.25rem 0.75rem; width: fit-content;">
                            <i class="fas fa-calendar-alt me-1"></i>December 15, 2024
                        </small>
                        <h4 class="card-title mb-3" style="color: #2563eb;">New Course Enrollment Open</h4>
                        <p class="card-text text-muted">We're excited to announce that enrollment for our Spring 2025 courses is now open. Limited seats available!</p>
                        <a href="#" class="btn btn-sm text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
                        <i class="fas fa-newspaper fa-4x text-white" style="opacity: 0.3;"></i>
                    </div>
                    <div class="card-body p-4">
                        <small class="badge rounded-pill d-block mb-2" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); color: white; padding: 0.25rem 0.75rem; width: fit-content;">
                            <i class="fas fa-calendar-alt me-1"></i>December 10, 2024
                        </small>
                        <h4 class="card-title mb-3" style="color: #2563eb;">Exam Success Stories</h4>
                        <p class="card-text text-muted">Congratulations to all our students who passed their exams this season. Read their inspiring success stories.</p>
                        <a href="#" class="btn btn-sm text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
                        <i class="fas fa-newspaper fa-4x text-white" style="opacity: 0.3;"></i>
                    </div>
                    <div class="card-body p-4">
                        <small class="badge rounded-pill d-block mb-2" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); color: white; padding: 0.25rem 0.75rem; width: fit-content;">
                            <i class="fas fa-calendar-alt me-1"></i>December 5, 2024
                        </small>
                        <h4 class="card-title mb-3" style="color: #2563eb;">Updated Study Materials</h4>
                        <p class="card-text text-muted">We've updated our library with the latest 2024-25 guidelines and study materials. Check them out now!</p>
                        <a href="#" class="btn btn-sm text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($news->count() > 0)
        <div class="text-center mt-5">
            <a href="#news-section" class="btn btn-lg text-white scroll-to-news" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; padding: 0.75rem 2rem; border-radius: 10px;">View All News</a>
        </div>
        @endif
    </div>
</section>

<!-- Testimonials Preview -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%); overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 25% 30%, rgba(37, 99, 235, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 75% 70%, rgba(124, 58, 237, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container position-relative">
        <div class="text-center mb-5 px-3">
            <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">What Our Students Say</h2>
            <p class="lead text-muted mb-0" style="font-size: 1.25rem;">Success stories from our graduates</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-lg glass-card" style="border-radius: 24px; transition: all 0.3s ease;">
                    <div class="card-body p-5">
                        <div class="mb-4 text-center">
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                        </div>
                        <p class="card-text mb-4 text-center" style="font-size: 1.15rem; line-height: 1.8; font-style: italic; color: #374151;">"I cleared on my first attempt… highly recommended!"</p>
                        <p class="text-muted mb-0 text-center"><strong style="color: #2563eb; font-size: 1rem;">— MRCGP INT Candidate, Pakistan</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-lg glass-card" style="border-radius: 24px; transition: all 0.3s ease;">
                    <div class="card-body p-5">
                        <div class="mb-4 text-center">
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                            <i class="fas fa-star" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.3rem;"></i>
                        </div>
                        <p class="card-text mb-4 text-center" style="font-size: 1.15rem; line-height: 1.8; font-style: italic; color: #374151;">"Dr Sahar's notes alone helped me pass."</p>
                        <p class="text-muted mb-0 text-center"><strong style="color: #2563eb; font-size: 1rem;">— MRCGP INT Candidate, Dubai</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('testimonials') }}" class="btn btn-lg text-white shadow-lg" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; padding: 0.875rem 2.5rem; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">
                <i class="fas fa-arrow-right me-2"></i>View All Testimonials
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-5 position-relative" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #ffffff 100%); overflow: hidden;">
    <div class="position-absolute top-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 85% 15%, rgba(37, 99, 235, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 15% 85%, rgba(124, 58, 237, 0.03) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container position-relative">
        <div class="text-center mb-5 px-3">
            <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1.2;">Frequently Asked Questions</h2>
            <p class="lead text-muted mb-0" style="font-size: 1.25rem;">Everything you need to know about our courses</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq1">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-user-md me-3"></i>Who is this course for?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Doctors preparing for <strong>MRCGP INT South Asia (AKT & OSCE)</strong> and <strong>MCPS Family Medicine</strong>. Ideal for both first-time and repeat candidates.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq2">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-clipboard-list me-3"></i>What does the course cover?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Complete preparation for <strong>AKT and OSCE</strong>, including MCQs, clinical reasoning, communication skills, and primary care exam scenarios.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq3">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-video me-3"></i>How are classes delivered?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Live online interactive sessions, MCQ discussions, OSCE walkthroughs, and active participation.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq4">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-folder-open me-3"></i>Where is the study material available?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-2">All materials are uploaded to the <strong>official course website</strong>:</p>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1"><i class="fas fa-file-pdf me-2" style="color: #2563eb;"></i>PDF notes</li>
                                    <li class="mb-1"><i class="fas fa-question-circle me-2" style="color: #2563eb;"></i>MCQ explanations</li>
                                    <li class="mb-0"><i class="fas fa-clipboard-check me-2" style="color: #2563eb;"></i>OSCE frameworks</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq5">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-download me-3"></i>Can I download the material?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <div class="d-flex align-items-start mb-2">
                                    <i class="fas fa-check-circle me-2 mt-1" style="color: #10b981; font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Yes — PDF files only.</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-times-circle me-2 mt-1" style="color: #ef4444; font-size: 1.2rem;"></i>
                                    <div>
                                        Recordings and videos stay online.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq6">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-play-circle me-3"></i>Are class recordings provided?
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Yes. All recordings are available on the website for enrolled students.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 7 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq7">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-sync-alt me-3"></i>Are guidelines updated?
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="faq7" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Yes. Teaching follows the latest <strong>NICE, WHO, UK primary care</strong>, and <strong>locally relevant guidelines</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 8 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq8">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-briefcase me-3"></i>Is this suitable for working doctors?
                            </button>
                        </h2>
                        <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="faq8" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Absolutely. Evening classes, access to recordings, and structured content.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 9 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq9">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-comments me-3"></i>Will this help with OSCE communication skills?
                            </button>
                        </h2>
                        <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="faq9" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Yes — structured consultation, ethics, red flags, and examiner expectations are covered.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 10 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq10">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-clock me-3"></i>How long is course access?
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="faq10" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Access continues until your exam date.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 11 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq11">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-globe me-3"></i>Can international candidates join?
                            </button>
                        </h2>
                        <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="faq11" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Yes — especially those appearing for <strong>MRCGP INT South Asia</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 12 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq12">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-star me-3"></i>What makes this course unique?
                            </button>
                        </h2>
                        <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="faq12" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Focus on real exam scenarios, clinical reasoning, and complete <strong>AKT + OSCE preparation in one program</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 13 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq13">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-user-plus me-3"></i>How do I register?
                            </button>
                        </h2>
                        <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="faq13" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <p class="mb-0">Register online. You'll receive login details and access to all course material.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 14 -->
                    <div class="accordion-item border-0 shadow-sm mb-3 glass-card" style="border-radius: 20px; overflow: hidden;">
                        <h2 class="accordion-header" id="faq14">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(79, 70, 229, 0.05) 100%); color: #2563eb; border: none;">
                                <i class="fas fa-chalkboard-teacher me-3"></i>Who is the instructor?
                            </button>
                        </h2>
                        <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="faq14" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="background: #ffffff; padding: 1.5rem;">
                                <div class="p-4" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%); border-radius: 15px; border-left: 4px solid #2563eb;">
                                    <h5 class="fw-bold mb-2" style="color: #2563eb;"><i class="fas fa-user-md me-2"></i>Dr. Sahar Aslam</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><i class="fas fa-certificate me-2" style="color: #2563eb;"></i>MRCGP (INT) South Asia</li>
                                        <li class="mb-1"><i class="fas fa-certificate me-2" style="color: #2563eb;"></i>MCPS Family Medicine</li>
                                        <li class="mb-0"><i class="fas fa-stethoscope me-2" style="color: #2563eb;"></i>Specialist Family Physician</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%); overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="position-absolute bottom-0 end-0 w-100 h-100" style="background: radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%); pointer-events: none;"></div>
    <div class="container text-center position-relative">
        <h2 class="display-4 fw-bold mb-4" style="text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2); letter-spacing: -0.5px;">Ready to Start Your Journey?</h2>
        <p class="lead mb-5" style="font-size: 1.35rem; text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1); opacity: 0.95;">Join hundreds of successful students who have passed their exams with Dr. Sahar Aslam</p>
        <div class="d-flex gap-4 justify-content-center flex-wrap">
            @auth
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 shadow-lg" style="border-radius: 12px; font-weight: 600; transition: all 0.3s ease; font-size: 1.1rem;">
                <i class="fas fa-rocket me-2"></i>Enroll Now
            </a>
            @else
            <a href="{{ route('register') }}" class="btn btn-success btn-lg px-5 shadow-lg" style="border-radius: 12px; font-weight: 600; transition: all 0.3s ease; font-size: 1.1rem;">
                <i class="fas fa-user-plus me-2"></i>Signup to Enroll
            </a>
            @endauth
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-5" style="border-radius: 12px; border-width: 2.5px; font-weight: 600; transition: all 0.3s ease; font-size: 1.1rem;">
                <i class="fas fa-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>


<style>
/* Brand Colors - Only Logo Colors */
:root {
    --brand-blue: #2563eb;
    --brand-indigo: #4f46e5;
    --brand-purple: #7c3aed;
    --brand-gradient: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #7c3aed 100%);
    --brand-gradient-text: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
}

/* Smooth Scroll Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Section Animations */
section {
    animation: fadeIn 0.6s ease-out;
}

/* Enhanced Card Shadows */
.glass-card {
    box-shadow: 0 10px 40px 0 rgba(31, 38, 135, 0.2) !important;
}

.glass-card:hover {
    box-shadow: 0 15px 50px 0 rgba(31, 38, 135, 0.3) !important;
}

/* Glassmorphism Effects */
.glass-card {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
}

.glass-card-dark {
    background: rgba(37, 99, 235, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
    transition: all 0.3s ease;
}

.glass-card-dark:hover {
    background: rgba(37, 99, 235, 0.15);
    transform: translateY(-6px);
    box-shadow: 0 15px 45px 0 rgba(31, 38, 135, 0.35);
}

.glass-card-dark:hover .position-absolute {
    opacity: 1 !important;
}

/* Consistent Card Hover Effects with Glassmorphism */
.card:not(.platform-feature-card) {
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.card:not(.platform-feature-card):hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2) !important;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
}

/* Gallery hover effect */
.gallery-card:hover .position-absolute {
    opacity: 1 !important;
}

.gallery-card:hover .card-img-top {
    transform: scale(1.05);
}

/* Platform Features Card Motion Effects */
.card.platform-feature-card {
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), 
                box-shadow 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                background 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    cursor: pointer !important;
    position: relative !important;
    will-change: transform !important;
    transform-style: preserve-3d !important;
}

.card.platform-feature-card:hover {
    transform: translateY(-12px) scale(1.03) !important;
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.3) !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
}

.card.platform-feature-card .feature-icon {
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    display: inline-block !important;
    will-change: transform !important;
}

.card.platform-feature-card:hover .feature-icon {
    transform: scale(1.2) rotate(-5deg) !important;
    animation: iconBounce 0.6s ease-in-out !important;
}

.card.platform-feature-card:hover .feature-icon i {
    animation: iconPulse 0.6s ease-in-out !important;
    display: inline-block !important;
}

@keyframes iconBounce {
    0%, 100% {
        transform: scale(1.2) rotate(-5deg);
    }
    50% {
        transform: scale(1.3) rotate(-8deg);
    }
}

@keyframes iconPulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

/* Button Hover Effects */
.btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

/* Override any Bootstrap colors to use brand colors only */
.text-primary {
    color: var(--brand-blue) !important;
}

.bg-primary {
    background: var(--brand-gradient) !important;
}

/* Ensure all badges use brand colors */
.badge {
    background: var(--brand-gradient) !important;
    color: white !important;
}


/* FAQ Accordion Styles */
.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%) !important;
    color: #2563eb !important;
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
    border-color: #2563eb;
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform: rotate(180deg);
}

.accordion-item {
    transition: all 0.3s ease;
}

.accordion-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15) !important;
}


/* Slider Styles */
#welcomeSlider {
    position: relative;
}

#welcomeSlider .slider-image {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
    width: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
}

#welcomeSlider .carousel-item.active .slider-image {
    animation: zoomIn 15s ease-in-out infinite;
}

@keyframes zoomIn {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

#welcomeSlider .carousel-item {
    transition: opacity 0.6s ease-in-out;
}

#welcomeSlider .carousel-control-prev,
#welcomeSlider .carousel-control-next {
    width: 55px;
    height: 55px;
    background-color: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.9;
    transition: all 0.3s ease;
    z-index: 10;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

#welcomeSlider .carousel-control-prev {
    left: 30px;
}

#welcomeSlider .carousel-control-next {
    right: 30px;
}

#welcomeSlider .carousel-control-prev:hover,
#welcomeSlider .carousel-control-next:hover {
    background-color: rgba(255, 255, 255, 0.5);
    opacity: 1;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

#welcomeSlider .carousel-indicators {
    bottom: 20px;
}

#welcomeSlider .carousel-indicators button {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.4);
    border: 2px solid rgba(255, 255, 255, 0.8);
    margin: 0 6px;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
}

#welcomeSlider .carousel-indicators button:hover {
    background-color: rgba(255, 255, 255, 0.7);
    transform: scale(1.1);
}

#welcomeSlider .carousel-indicators button.active {
    background-color: white;
    transform: scale(1.3);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
}

#welcomeSlider .display-5 {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

#welcomeSlider .lead {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

@media (max-width: 768px) {
    #welcomeSlider .slider-image {
        height: 400px !important;
    }
    
    #welcomeSlider .display-5 {
        font-size: 1.75rem;
    }
    
    #welcomeSlider .lead {
        font-size: 1rem;
    }
    
    #welcomeSlider .carousel-control-prev,
    #welcomeSlider .carousel-control-next {
        width: 40px;
        height: 40px;
    }
    
    #welcomeSlider .carousel-control-prev {
        left: 15px;
    }
    
    #welcomeSlider .carousel-control-next {
        right: 15px;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
}
</style>

<script>
// Initialize carousel with auto-rotation
document.addEventListener('DOMContentLoaded', function() {
    const carouselElement = document.getElementById('welcomeSlider');
    if (carouselElement && typeof bootstrap !== 'undefined' && bootstrap.Carousel) {
        const carousel = new bootstrap.Carousel(carouselElement, {
            interval: 4000,
            ride: 'carousel',
            pause: false,
            wrap: true
        });
        
        // Ensure carousel continues cycling continuously
        carousel.cycle();
    }
});
</script>
@endsection
