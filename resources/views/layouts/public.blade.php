<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PGIFM - Postgraduate Family Institute of Medicine Exam Prep') | Dr. Sahar Aslam</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo1.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .navbar {
            padding: 0.75rem 0;
            min-height: 70px;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2563eb !important;
            padding: 0;
            margin-right: 2rem;
        }
        .navbar-brand img {
            height: 60px;
            width: auto;
            object-fit: contain;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: high-quality;
            -ms-interpolation-mode: bicubic;
            transition: transform 0.3s ease;
        }
        .navbar-brand img:hover {
            transform: scale(1.05);
        }
        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            color: #4b5563 !important;
        }
        .nav-link:hover {
            color: #2563eb !important;
            transform: translateY(-1px);
        }
        .nav-link.btn {
            color: white !important;
            background-color: #2563eb;
            border: none;
            margin-left: 10px;
            padding: 0.5rem 1.25rem !important;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .nav-link.btn:hover {
            background-color: #1d4ed8;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .dropdown-menu {
            border-radius: 12px;
            border: 1px solid rgba(37, 99, 235, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }
        .dropdown-item {
            padding: 0.6rem 1.25rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .dropdown-item:hover {
            background-color: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            padding-left: 1.5rem;
        }
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }
        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }
        /* Ensure dropdown menus appear above news ticker */
        .navbar .dropdown-menu {
            z-index: 1050 !important;
        }
        .navbar {
            z-index: 1030;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="PGIFM Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="coursesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Courses
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            <li><a class="dropdown-item" href="{{ route('courses') }}"><i class="fas fa-list me-2"></i>All Courses</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('courses') }}#mcps-family-medicine"><i class="fas fa-graduation-cap me-2"></i>MCPS Family Medicine</a></li>
                            <li><a class="dropdown-item" href="{{ route('courses') }}#mrcgp-int"><i class="fas fa-certificate me-2"></i>MRCGP INT South Asia</a></li>
                            <li><a class="dropdown-item" href="{{ route('courses') }}#mcps-toacs"><i class="fas fa-stethoscope me-2"></i>MCPS Family Medicine TOACS</a></li>
                            <li><a class="dropdown-item" href="{{ route('courses') }}#mrcgp-osce"><i class="fas fa-clipboard-check me-2"></i>MRCGP [INT] South Asia OSCE</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('courses') }}#short-courses"><i class="fas fa-book-medical me-2"></i>Short Courses & Workshops</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mentorship') }}">Mentorship</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('library.index') }}">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('testimonials') }}">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white px-3 rounded" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle me-2"></i>
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->type === 1)
                                    <li><a class="dropdown-item" href="{{ route('student.profile.show') }}"><i class="fas fa-user-circle me-2"></i>My Profile</a></li>
                                @elseif(Auth::user()->type === 2)
                                    <li><a class="dropdown-item" href="{{ route('doctor.profile.show') }}"><i class="fas fa-user-circle me-2"></i>My Profile</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- News Ticker Slider -->
    @if(isset($news) && $news->count() > 0)
    <div class="news-ticker-container" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.95) 0%, rgba(79, 70, 229, 0.95) 100%); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255, 255, 255, 0.1); position: sticky; top: 76px; z-index: 1000; overflow: hidden;">
        <div class="news-ticker-wrapper" style="display: flex; align-items: center; padding: 0.75rem 0;">
            <div class="news-ticker-label" style="background: rgba(255, 255, 255, 0.2); padding: 0.5rem 1.5rem; color: white; font-weight: 600; white-space: nowrap; border-right: 1px solid rgba(255, 255, 255, 0.2); flex-shrink: 0;">
                <i class="fas fa-bullhorn me-2"></i>Latest News
            </div>
            <div class="news-ticker-content" style="flex: 1; overflow: hidden; position: relative; width: 100%;">
                <div class="news-ticker-scroll" style="display: inline-flex; white-space: nowrap; will-change: transform;">
                    @foreach($news as $item)
                    <a href="{{ route('welcome') }}#news-section" class="news-item" style="display: inline-block; padding: 0 3rem; color: white; text-decoration: none; border-right: 1px solid rgba(255, 255, 255, 0.2); cursor: pointer; transition: all 0.3s ease; flex-shrink: 0; white-space: nowrap;">
                        <span class="news-date" style="opacity: 0.8; margin-right: 1rem; font-size: 0.85rem;">
                            <i class="fas fa-calendar-alt me-1"></i>{{ $item->created_at->format('M d') }}
                        </span>
                        <span class="news-title" style="font-weight: 500;">{{ $item->title }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        .news-ticker-content {
            overflow: hidden !important;
            position: relative;
            width: 100%;
        }
        .news-ticker-scroll {
            display: inline-flex !important;
            animation: scroll-news 15s linear infinite;
        }
        @keyframes scroll-news {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        .news-ticker-container:hover .news-ticker-scroll {
            animation-play-state: paused !important;
        }
        .news-item {
            transition: all 0.3s ease;
        }
        .news-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.02);
            color: #ffffff !important;
        }
        .news-item:hover .news-title {
            font-weight: 600;
        }
        .news-item:hover .news-date {
            opacity: 1 !important;
        }
        @media (max-width: 768px) {
            .news-ticker-label {
                padding: 0.5rem 1rem !important;
                font-size: 0.85rem;
            }
            .news-item {
                padding: 0 1.5rem !important;
            }
            .news-title {
                font-size: 0.85rem;
            }
        }
    </style>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>PGIFM</h5>
                    <p>Postgraduate Family Institute of Medicine Exam Preparation Platform</p>
                    <p class="text-muted">Online Medical Educator & Exam Mentor</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="{{ route('courses') }}" class="text-white-50 text-decoration-none">Courses</a></li>
                        <li class="mb-2"><a href="{{ route('mentorship') }}" class="text-white-50 text-decoration-none">Mentorship</a></li>
                        <li class="mb-2"><a href="{{ route('testimonials') }}" class="text-white-50 text-decoration-none">Testimonials</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact</h5>
                    <p class="mb-1">Email: <a href="mailto:saharaslam@gmail.com" class="text-white-50 text-decoration-none">saharaslam@gmail.com</a></p>
                    <p class="mb-1">WhatsApp: <a href="https://wa.me/923333451936" class="text-white-50 text-decoration-none">0333-3451936</a></p>
                    <p class="mb-1">Instagram: <a href="https://instagram.com/its.saharaslam" target="_blank" class="text-white-50 text-decoration-none">@its.saharaslam</a></p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center text-muted">
                <p>&copy; {{ date('Y') }} PGIFM - Dr. Sahar Aslam. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

