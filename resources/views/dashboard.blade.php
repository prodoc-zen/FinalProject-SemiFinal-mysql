<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuturo | Student Dashboard</title>
    <!-- Load Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Load Font for aesthetics -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles for Fixed Dashboard Layout -->
    <link rel="stylesheet" href="{{ asset('css/dashboard-student.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-student-browse.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-student-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-student-session.css') }}">


</head>
<body>
    
    <!-- Desktop Sidebar -->
    <nav class="sidebar d-none d-lg-flex">
        <a class="navbar-brand d-flex align-items-center mb-4" href="{{ route('student.dashboard') }}">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:32px;height:32px;background-color:var(--bs-primary);">
               T
            </div>
            <span class="fs-5 fw-bold brand-title">Tuturo</span>
        </a>

        <div class="d-flex align-items-center gap-3 pb-4 mb-4 border-bottom">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name,0,2)) }}</div>
            <div>
                <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                <div class="small text-muted">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>

        <ul class="nav flex-column sidebar-nav">
            <li class="nav-item">
                <a class="nav-link active" id="overviewLink" onclick="goToOverview()"><i class="fas fa-home"></i> Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="browseLink" onclick="goToBrowseTutor()"> <i class="fas fa-search"></i> Browse Tutors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="sessionsLink" onclick="goToSessions()"><i class="fas fa-calendar-alt"></i> My Sessions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a>
            </li>
        </ul>

        <div class="mt-auto pt-3 border-top">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt"></i> Log out
                </button>
            </form>
        </div>
    </nav>


    <!-- Main Wrapper -->
        <div class="main-wrapper">
                <nav class="navbar top-navbar fixed-header">
                    <div class="container-fluid p-0">
                        <button class="navbar-toggler d-lg-none border-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a class="navbar-brand d-lg-none">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:24px;height:24px;background-color:var(--bs-primary);">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
                            <span>{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
                            <span class="d-none d-md-inline me-2 text-muted fw-semibold">{{ Auth::user()->name }}</span>
                            <li class="nav-item">
                                
                                <a class="nav-link d-flex align-items-center" href="{{ route('profile.edit') }}">
                                    <div class="user-avatar" style="width:32px;height:32px;font-size:0.8rem;">{{ strtoupper(substr(Auth::user()->name,0,2)) }}</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
            <div id="dashboardCarousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">

                    <div class="carousel-item active" id="slideDashboard">
                        @include('students.partials.dashboard-main')
                    </div>

                    <div class="carousel-item" id="slideBrowse">
                        @include('students.partials.dashboard-browse')
                    </div>

                    <div class="carousel-item" id="slideBrowse">
                        @include('students.partials.dashboard-sessions')
                    </div>

                </div>
            </div>

            <!-- Booking Modal -->
            @include('students.partials.dashboard-modal')
            

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/dashboard-student-carousel.js') }}"></script>
    <script src="{{ asset('js/dashboard-student-session.js') }}"></script>
    <script src="{{ asset('js/dashboard-student-modal.js') }}"></script>
    

</body>
</html>
