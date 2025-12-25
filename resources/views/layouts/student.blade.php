<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Dashboard - PGIFM') | Dr. Sahar Aslam</title>
    
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
        .student-sidebar {
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
        
        .student-sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .student-sidebar-header img {
            height: 60px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        
        .student-sidebar-header h5 {
            color: white;
            font-weight: 600;
            margin-top: 0.5rem;
            margin-bottom: 0;
        }
        
        .student-sidebar-menu {
            padding: 1rem 0;
        }
        
        .student-sidebar-menu .nav-link {
            color: #4b5563;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 0.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .student-sidebar-menu .nav-link:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            transform: translateX(5px);
        }
        
        .student-sidebar-menu .nav-link.active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
            color: #10b981;
            border-left: 4px solid #10b981;
        }
        
        .student-sidebar-menu .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        .student-main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        .student-topbar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .student-content-wrapper {
            padding: 2rem;
        }
        
        @media (max-width: 768px) {
            .student-sidebar {
                transform: translateX(-100%);
            }
            
            .student-sidebar.show {
                transform: translateX(0);
            }
            
            .student-main-content {
                margin-left: 0;
            }
        }
        
        /* Card Hover Effects */
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15) !important;
        }
        
        /* Scrollbar for Sidebar */
        .student-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .student-sidebar::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        
        .student-sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 10px;
        }
        
        .student-sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="student-sidebar" id="studentSidebar">
        <div class="student-sidebar-header">
            <a href="{{ route('welcome') }}" class="d-block text-center">
                <img src="{{ asset('images/logo1.png') }}" alt="PGIFM Logo" class="mb-2">
                <h5>Student Dashboard</h5>
            </a>
        </div>
        
        <nav class="student-sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.dashboard') || request()->routeIs('home') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.courses.*') ? 'active' : '' }}" href="{{ route('student.courses.index') }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span>My Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.classes.*') ? 'active' : '' }}" href="{{ route('student.classes.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>My Classes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('courses') ? 'active' : '' }}" href="{{ route('courses') }}">
                        <i class="fas fa-book"></i>
                        <span>Browse Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('library.*') ? 'active' : '' }}" href="{{ route('library.index') }}">
                        <i class="fas fa-book-open"></i>
                        <span>Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mentorship') ? 'active' : '' }}" href="{{ route('mentorship') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Mentorship</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}">
                        <i class="fas fa-star"></i>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <hr class="mx-3">
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.profile.*') ? 'active' : '' }}" href="{{ route('student.profile.show') }}">
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
    <div class="student-main-content">
        <!-- Top Bar -->
        <div class="student-topbar">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link d-md-none me-3" id="sidebarToggle" type="button">
                        <i class="fas fa-bars fa-lg" style="color: #10b981;"></i>
                    </button>
                    <h4 class="mb-0 fw-bold" style="color: #10b981;">
                        @yield('page-title', 'Dashboard')
                    </h4>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <span class="fw-semibold" style="color: #10b981;">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('student.profile.show') }}">
                                    <i class="fas fa-user-circle me-2"></i>My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.profile.edit') }}">
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
        <div class="student-content-wrapper">
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
            
            @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #17a2b8;">
                <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @yield('student-content')
        </div>
    </div>
    
    <!-- Chatbot Component - Available on all Student Dashboard Pages -->
    @include('components.chatbot')
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('studentSidebar').classList.toggle('show');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('studentSidebar');
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
