<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorMatch | Student Dashboard</title>
    <!-- Load Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Load Font for aesthetics -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles for Fixed Dashboard Layout -->
    <style>
        :root {
            --bs-primary: #558B2F; 
            --bs-secondary: #8BC34A;
            --custom-bg-light: #F9FFF5; 
            --custom-border: #eef0f2;
            --sidebar-width: 280px;
            --header-height: 65px; 
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background-color: #fff;
            margin: 0;
            padding-left: var(--sidebar-width);
        }

        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: #4A7727; 
            border-color: #4A7727;
        }
        .text-primary {
            color: var(--bs-primary) !important;
        }
        .user-avatar {
            width: 40px; 
            height: 40px; 
            background-color: var(--bs-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }
        .stat-card {
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--custom-border);
        }
        .stat-card .icon-circle {
            width: 50px;
            height: 50px;
            background-color: rgba(85, 139, 47, 0.1);
            color: var(--bs-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .next-session-card {
            background: linear-gradient(135deg, var(--bs-primary), #689F38);
            color: white;
            border: none !important;
        }
        .sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid var(--custom-border);
            height: 100vh; 
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020; 
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            overflow-y: auto;
        }
        .sidebar-nav .nav-link {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: #495057;
            transition: background-color 0.2s;
            font-weight: 500;
        }
        .sidebar-nav .nav-link i {
            width: 20px;
            margin-right: 12px;
        }
        .sidebar-nav .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--bs-primary);
        }
        .sidebar-nav .nav-link.active {
            background-color: var(--bs-primary);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(85, 139, 47, 0.3);
        }
        .sidebar-nav .nav-link.active i {
            color: white;
        }
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            width: 100%; 
        }
        .fixed-header {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1000;
            background-color: #ffffff;
            border-bottom: 1px solid var(--custom-border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            width: calc(100% - var(--sidebar-width)); 
            height: var(--header-height);
            padding: 0.75rem 1.5rem;
        }
        .content-area {
            flex-grow: 1;
            background-color: var(--custom-bg-light);
            padding: 2.5rem;
            overflow-y: auto;
            padding-top: calc(2.5rem + var(--header-height)); 
            padding-bottom: 3rem; 
        }
        @media (max-width: 991.98px) {
            body { padding-left: 0; }
            .sidebar { display: none; }
            .fixed-header { width: 100%; padding: 0.75rem 1rem; }
            .content-area { padding: 1.5rem; padding-top: calc(1.5rem + var(--header-height)); }
        }
    </style>
</head>
<body>
    
    <!-- Desktop Sidebar -->
    <nav class="sidebar d-none d-lg-flex">
        <a class="navbar-brand d-flex align-items-center mb-4" href="{{ route('dashboard') }}">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:32px;height:32px;background-color:var(--bs-primary);">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>
            <span class="fs-5 fw-bold text-primary">TutorMatch</span>
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
                <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="fas fa-search"></i> Browse Tutors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="fas fa-calendar-alt"></i> My Sessions</a>
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

    <!-- Mobile Sidebar -->
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold text-primary">TutorMatch</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Overview</a></li>
                <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-search"></i> Browse Tutors</a></li>
                <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-calendar-alt"></i> My Sessions</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a></li>
                <li class="nav-item mt-3 pt-3 border-top">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                            <i class="fas fa-sign-out-alt"></i> Log out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <nav class="navbar top-navbar fixed-header">
            <div class="container-fluid p-0">
                <button class="navbar-toggler d-lg-none border-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand d-lg-none" href="{{ route('dashboard') }}">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:24px;height:24px;background-color:var(--bs-primary);">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
                    <span>{{ Auth::user()->name }}</span>
                </a>

                <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <div class="user-avatar" style="width:32px;height:32px;font-size:0.8rem;">{{ strtoupper(substr(Auth::user()->name,0,2)) }}</div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content-area">
            <div class="mb-5">
                <h2 class="fw-bolder fs-3">Welcome back, {{ Auth::user()->name }}!</h2>
                <p class="text-muted lead-sm">Ready to ace that next exam? Here's your learning overview.</p>
            </div>

            <div class="row g-4">
                <!-- Total Sessions Card -->
                <div class="col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Total Sessions</p>
                                <h2 class="display-5 fw-bold text-dark mb-0">12</h2>
                                <p class="small text-muted mb-0">Completed & scheduled</p>
                            </div>
                            <div class="icon-circle"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Upcoming Card -->
                <div class="col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Upcoming</p>
                                <h2 class="display-5 fw-bold text-dark mb-0">1</h2>
                                <p class="small text-muted mb-0">Confirmed sessions</p>
                            </div>
                            <div class="icon-circle"><i class="fas fa-calendar-check"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Subjects Card -->
                <div class="col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Active Subjects</p>
                                <h2 class="display-5 fw-bold text-dark mb-0">3</h2>
                                <p class="small text-muted mb-0">Math, Physics, English</p>
                            </div>
                            <div class="icon-circle"><i class="fas fa-book-open"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Session Card -->
            <div class="row g-4 mt-4">
                <div class="col-12">
                    <div class="card p-4 rounded-3 shadow-lg next-session-card h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-hourglass-half fa-2x me-3 opacity-75"></i>
                            <h3 class="fs-4 fw-bold mb-0">Your Next Session</h3>
                        </div>
                        <div class="card-body p-0">
                            <h4 class="fw-semibold text-white mb-2">Calculus 101: Limits & Derivatives</h4>
                            <p class="mb-1 fw-light"><i class="fas fa-user-circle me-2"></i> Tutor: Sarah Jenkins</p>
                            <p class="mb-1 fw-light"><i class="fas fa-clock me-2"></i> Date/Time: **Fri, Feb 28th at 4:00 PM EST**</p>
                            <p class="mb-3 fw-light"><i class="fas fa-bullseye me-2"></i> Topic: Reviewing the Chain Rule</p>
                            <p class="mt-4 fw-semibold small text-white opacity-75">
                                Session details and the join link will be available closer to the appointment time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
