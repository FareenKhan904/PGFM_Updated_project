<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Doctor Dashboard - PGIFM') | Dr. Sahar Aslam</title>
    
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
            background: linear-gradient(to bottom, #f8fafc 0%, #ffffff 100%);
        }
        
        /* Sidebar Styles */
        .doctor-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        
        .doctor-sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
        }
        
        .doctor-sidebar-header img {
            height: 60px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        
        .doctor-sidebar-header h5 {
            color: white;
            font-weight: 600;
            margin-top: 0.5rem;
            margin-bottom: 0;
        }
        
        .doctor-sidebar-menu {
            padding: 1rem 0;
        }
        
        .doctor-sidebar-menu .nav-link {
            color: #4b5563;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 0.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .doctor-sidebar-menu .nav-link:hover {
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            transform: translateX(5px);
        }
        
        .doctor-sidebar-menu .nav-link.active {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15) 0%, rgba(79, 70, 229, 0.15) 100%);
            color: #2563eb;
            border-left: 4px solid #2563eb;
        }
        
        .doctor-sidebar-menu .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        .doctor-main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        .doctor-topbar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .doctor-content-wrapper {
            padding: 2rem;
        }
        
        @media (max-width: 768px) {
            .doctor-sidebar {
                transform: translateX(-100%);
            }
            
            .doctor-sidebar.show {
                transform: translateX(0);
            }
            
            .doctor-main-content {
                margin-left: 0;
            }
        }
        
        /* Card Hover Effects */
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15) !important;
        }
        
        /* Scrollbar for Sidebar */
        .doctor-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .doctor-sidebar::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        
        .doctor-sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            border-radius: 10px;
        }
        
        .doctor-sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #4338ca 100%);
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="doctor-sidebar" id="doctorSidebar">
        <div class="doctor-sidebar-header">
            <a href="{{ route('welcome') }}" class="d-block text-center">
                <img src="{{ asset('images/logo1.png') }}" alt="PGIFM Logo" class="mb-2" style="height: 75px; width: auto; object-fit: contain;">
                <h5>Doctor Dashboard</h5>
            </a>
        </div>
        
        <nav class="doctor-sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}" href="{{ route('doctor.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.courses.*') ? 'active' : '' }}" href="{{ route('doctor.courses.index') }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.enrollments.*') ? 'active' : '' }}" href="{{ route('doctor.enrollments.index') }}">
                        <i class="fas fa-user-check"></i>
                        <span>Requests</span>
                        @php
                            $pendingCount = \App\Models\Enrollment::whereHas('course', function($query) {
                                $query->where('user_id', auth()->id());
                            })->where('status', \App\Models\Enrollment::STATUS_PENDING)->count();
                        @endphp
                        @if($pendingCount > 0)
                        <span class="badge bg-danger rounded-pill ms-auto">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.news.*') ? 'active' : '' }}" href="{{ route('doctor.news.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <span>News</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.gallery.*') ? 'active' : '' }}" href="{{ route('doctor.gallery.index') }}">
                        <i class="fas fa-images"></i>
                        <span>Gallery</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.slider.*') ? 'active' : '' }}" href="{{ route('doctor.slider.index') }}">
                        <i class="fas fa-sliders-h"></i>
                        <span>Slider Images</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('library.*') ? 'active' : '' }}" href="{{ route('library.manage') }}">
                        <i class="fas fa-book-open"></i>
                        <span>Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.classes.*') ? 'active' : '' }}" href="{{ route('doctor.classes.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Classes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.mentorship.*') ? 'active' : '' }}" href="{{ route('doctor.mentorship.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Mentorship</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <hr class="mx-3">
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.profile.*') ? 'active' : '' }}" href="{{ route('doctor.profile.show') }}">
                        <i class="fas fa-user-circle"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">
                        <i class="fas fa-home"></i>
                        <span>Public Site</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <div class="doctor-main-content">
        <!-- Top Bar -->
        <div class="doctor-topbar">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link d-md-none me-3" id="sidebarToggle" type="button">
                        <i class="fas fa-bars fa-lg" style="color: #2563eb;"></i>
                    </button>
                    <h4 class="mb-0 fw-bold" style="color: #2563eb;">
                        @yield('page-title', 'Dashboard')
                    </h4>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <span class="fw-semibold" style="color: #2563eb;">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('doctor.profile.show') }}">
                                    <i class="fas fa-user-circle me-2"></i>My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('doctor.profile.edit') }}">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('welcome') }}">
                                    <i class="fas fa-home me-2"></i>Public Site
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="doctor-content-wrapper">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #10b981;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #ef4444;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @yield('doctor-content')
        </div>
    </div>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('doctorSidebar').classList.toggle('show');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('doctorSidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768 && sidebar && toggle) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target) && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>

