<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuturo | Tutor Dashboard</title>
    <!-- Load Bootstrap 5.3 CSS -->
    <link href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Load Font Awesome for icons -->

    <link rel="stylesheet" href="fontawesome-free-7.1.0-web/css/all.min.css">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Load Font for aesthetics -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link id="dashboard-tutor-css" rel="stylesheet" href="{{ asset('css/dashboard-tutor.css') }}">
    <link id="dashboard-tutor-session-css" rel="stylesheet" href="{{ asset('css/dashboard-tutor-session.css') }}">
    <link id="dashboard-student-session-css" rel="stylesheet" href="{{ asset('css/dashboard-student-session.css') }}">
    <link id="dashboard-tutor-pending-css" rel="stylesheet" href="{{ asset('css/dashboard-tutor-pending.css') }}">
    
   
    
</head>
<body>
    
    <!-- Mock User Data --><script>

        const getInitials = (name) => name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
    </script>
    
    <nav class="sidebar d-none d-lg-flex">
        <a class="navbar-brand d-flex align-items-center mb-4" href="{{ route('tutor.dashboard') }}">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:32px;height:32px;background-color:var(--bs-primary);">
               T
            </div>
            <span class="fs-5 fw-bold brand-title">Tuturo</span>
        </a>

        <div class="d-flex align-items-center gap-3 pb-4 mb-4 border-bottom">
            <img src="{{$tutor->profile_picture }}" 
            alt="Avatar" 
            class="rounded-circle me-2" 
            style="width:32px; height:32px; object-fit:cover;">

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
                <a class="nav-link" id="sessionsLink" onclick="goToSessions()"><i class="fas fa-calendar-alt"></i>My Sessions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pendingRequestsLink" onclick="goToPendingRequests()"> <i class="fas fa-clock"></i>Session Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profileLink" onclick="goToProfile()"><i class="fas fa-user"></i> Profile</a>
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
        <!-- Fixed Header -->
        <nav class="navbar top-navbar fixed-header">
            <div class="container-fluid">
                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler d-lg-none border-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Mobile Brand -->
                <a class="navbar-brand d-lg-none text-dark d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:24px;height:24px;background-color:var(--bs-primary);font-size:0.75rem;">
                         <script>document.write(getInitials(MOCK_USER.name).substring(0,1));</script>
                    </div>
                    <span class="fw-bold"><script>document.write(MOCK_USER.name);</script></span>
                </a>

                <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
                    <li class="nav-item">
                        
                        <a class="nav-link d-flex align-items-center" href="#">
                            <span class="d-none d-md-inline me-2 text-muted fw-semibold">{{ Auth::user()->name  }}</span>
                            <img src="{{ $tutor->profile_picture }}" alt="Avatar" class="rounded-circle me-2" style="width:32px; height:32px; object-fit:cover;">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- MAIN CONTENT AREA -->
       <div id="dashboardCarousel" class="carousel slide carousel-fade" data-bs-interval="false">
            <div class="carousel-inner">

                <div class="carousel-item active" id="slideDashboard">
                    @include('tutors.partials.dashboard-main')
                </div>

                <div class="carousel-item" id="slideBrowse">
                    @include('tutors.partials.dashboard-sessions')
                </div>

                <div class="carousel-item" id="slideBrowse">
                    @include('tutors.partials.dashboard-pendingRequests')
                </div>

                <div class="carousel-item" id="slideProfile">
                    @include('tutors.partials.dashboard-profile')
                </div>

            </div>
        </div>
        
    </div>

    @include('tutors.partials.dashboard-modals');

    <input type="hidden" id="tutorName_profile" value="{{ $tutor->user->name }}">
    <input type="hidden" id="phone_profile" value="{{ $tutor->phone }}">
    <input type="hidden" id="address_profile" value="{{ $tutor->address }}">
    <input type="hidden" id="bio_profile" value="{{ $tutor->bio}}">
    <input type="hidden" id="hourlyRate_profile" value="{{ $tutor->hourly_rate }}">
    <input type="hidden" id="balance_profile" value="{{ $tutor->balance }}">
    <input type="hidden" id="profilePictureUrl_profile" value="{{ $tutor->profile_picture }}">
    
 



    

    {{-- <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
    <script src={{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }} ></script>
    <script src="{{ asset('js/dashboard-tutor-carousel.js') }}"></script>
    
    <script src="{{ asset('js/dashboard-tutor-modal.js') }}"></script>
    <script src="{{ asset('js/dashboard-tutor-profile.js') }}"></script>
    
</body>
</html>