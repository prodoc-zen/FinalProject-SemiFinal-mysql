<!DOCTYPE html>
<html lang="en">
<head>

    <!--
        Names: Borgueta, John Carlo L.
               Ompad, Mary Jasmin P.

        Date: 11/14/25
        Project: TutorMatch - Online Tutoring System
        File: welcome-new.blade.php
    
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuturo | Find Your Perfect Tutor</title>
    <!-- Load Bootstrap 5.3 CSS -->
    <link href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-7.1.0-web/css/all.min.css') }}">
    
    <!-- Custom Styles to define the green color scheme and background -->
    <style>
        
    </style>
    <!-- Load Font for aesthetics -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container-fluid container-lg px-4">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center me-auto" href="#">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width: 24px; height: 24px; background-color: var(--bs-primary);">T</div>
                <span class="fs-5 fw-bold text-dark">Tuturo</span>
            </a>
            
            <!-- Mobile Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-3 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-lg shadow-sm" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                        class="nav-link text-dark">
                            Sign Up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-5 py-md-5 py-lg-5">
        <div class="container-fluid container-lg px-4">
            <div class="row align-items-center">
                <!-- Hero Text Content -->
                <div class="col-md-6 mb-5 mb-md-0">
                    <h1 class="display-5 fw-bolder text-dark mb-4">
                        Find Your Perfect <span class="text-primary">Tutor</span>
                    </h1>
                    <p class="lead text-secondary-emphasis mb-5" style="color: #6c757d;">
                        Connect with expert tutors for personalized learning experiences. Whether you're a student seeking homework help or an adult learning new skills, TutorMatch brings education to life.
                    </p>
                    
                    <div class="d-flex gap-3 pt-3">
                        <a  href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-xl shadow-lg" type="button">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-xl border-2" type="button" style="--bs-btn-border-color: var(--bs-primary);">
                            Sign In
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
                    <img
                        src="images/tutorimage2.jpg"
                        alt="Family learning with a private tutor"
                        class="img-fluid rounded-xl shadow-lg"
                        style="max-width: 600px;"
                        onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=Tutor+Image+Loading+Error';"
                    >
                </div>
            </div>
        </div>
    </header>

    <!-- Why Choose Section -->
    <section class="py-5 bg-white shadow-sm">
        <div class="container-fluid container-lg px-4 text-center">
            <h2 class="fs-2 fw-bold text-dark mb-5 pt-3">
                Why Choose <span class="text-primary">Tuturo</span>?
            </h2>

            <!-- Feature Cards Grid -->
            <div class="row g-4 justify-content-center">
                
                <!-- Card 1: Expert Tutors -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-4 h-100 border-0 shadow-sm rounded-xl hover-lift">
                        <div class="mx-auto mb-3 bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-graduation-cap text-primary fs-4"></i>
                        </div>
                        <h3 class="fs-5 fw-semibold text-dark mb-2">Expert Tutors</h3>
                        <p class="text-muted small">
                            Learn from qualified professionals in numerous subjects.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Flexible Scheduling -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-4 h-100 border-0 shadow-sm rounded-xl hover-lift">
                        <div class="mx-auto mb-3 bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-calendar-alt text-primary fs-4"></i>
                        </div>
                        <h3 class="fs-5 fw-semibold text-dark mb-2">Flexible Scheduling</h3>
                        <p class="text-muted small">
                            Book sessions that fit perfectly into your busy schedule.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Personalized Learning -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-4 h-100 border-0 shadow-sm rounded-xl hover-lift">
                        <div class="mx-auto mb-3 bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-book-reader text-primary fs-4"></i>
                        </div>
                        <h3 class="fs-5 fw-semibold text-dark mb-2">Personalized Learning</h3>
                        <p class="text-muted small">
                            Dedicated sessions tailored specifically to your needs.
                        </p>
                    </div>
                </div>

                <!-- Card 4: Verified Reviews -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-4 h-100 border-0 shadow-sm rounded-xl hover-lift">
                        <div class="mx-auto mb-3 bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-star text-primary fs-4"></i>
                        </div>
                        <h3 class="fs-5 fw-semibold text-dark mb-2">Verified Reviews</h3>
                        <p class="text-muted small">
                            Read authentic feedback from real students and parents.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Image -->
            <div class="mt-5 pt-3">
                <img
                    src="images/tutorimage3.jpg"
                    alt="Students or professionals collaborating"
                    style="width:1000px; height:350px; object-fit:cover; border-radius:1rem;"
                    class="shadow-lg"
                    onerror="this.onerror=null; this.src='https://placehold.co/1000x350?text=Collaboration+Image+Loading+Error';"
                >
            </div>
        </div>
    </section>
    
    <!-- Simple Footer Bar -->
    <footer class="mt-5 py-4" style="background-color: var(--bs-primary);">
        <div class="text-center text-white small fw-medium">
            Ready to Start Learning? Join our community today!
        </div>
    </footer>

    <!-- Load Bootstrap 5.3 JS Bundle (Required for Navbar Toggler) -->
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>