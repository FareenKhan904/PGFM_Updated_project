<!-- Doctor Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#doctorNavbar" aria-controls="doctorNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="doctorNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}" href="{{ route('doctor.dashboard') }}">
                        <i class="fas fa-home me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.courses.*') ? 'active' : '' }}" href="{{ route('doctor.courses.index') }}">
                        <i class="fas fa-book me-1"></i>Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.news.*') ? 'active' : '' }}" href="{{ route('doctor.news.index') }}">
                        <i class="fas fa-newspaper me-1"></i>News
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('library.*') ? 'active' : '' }}" href="{{ route('library.manage') }}">
                        <i class="fas fa-book-open me-1"></i>Library
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.classes.*') ? 'active' : '' }}" href="{{ route('doctor.classes.index') }}">
                        <i class="fas fa-chalkboard-teacher me-1"></i>Classes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor.mentorship.*') ? 'active' : '' }}" href="{{ route('doctor.mentorship.index') }}">
                        <i class="fas fa-user-graduate me-1"></i>Mentorship
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



