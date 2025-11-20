<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorMatch | Sign In</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">


</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container-fluid container-lg px-4">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center me-auto" href="#">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width: 24px; height: 24px; background-color: var(--bs-primary);">T</div>
                <span class="fs-5 fw-bold text-dark">TutorMatch</span>
            </a>
            
            <!-- Mobile Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-3 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}"
                        class="btn btn-primary rounded-lg shadow-sm">
                            Sign Up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container-fluid d-flex flex-grow-1 p-0">
    <div class="row g-0 flex-grow-1">

        <!-- Left side image -->
        <div class="col-lg-6 d-none d-lg-flex auth-background">
            <div class="auth-content">
                <i class="fas fa-graduation-cap fa-3x mb-4 opacity-75"></i>
                <h2 class="fs-2 fw-semibold mb-3">Welcome to TutorMatch</h2>
                <p class="lead opacity-90">Connect with expert tutors and unlock your learning potential.</p>
            </div>
        </div>

        <!-- Right side login -->
        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center py-5"
             style="background-color: var(--custom-bg-light);">

            <div class="card p-4 p-md-5 shadow-lg border-0 rounded-3" style="max-width:450px; width:90%;">

                <h3 class="fs-4 fw-bold text-dark mb-2">Sign In to Your Account</h3>
                <p class="text-muted small mb-4">Enter your credentials.</p>

                

                <p class="fs-5 fw-semibold text-dark mb-1 mt-4" id="loginTitle">User Login</p>
                <p class="text-muted small mb-3" id="loginSubtitle">Access your learning dashboard.</p>

                <!-- Laravel Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="hidden" name="role" id="roleInput" value="student">

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold small text-dark">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 mt-4">
                        <label for="password" class="form-label fw-semibold small text-dark">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="form-check mt-4">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label small">Remember me</label>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                        @if (Route::has('password.request'))
                            <a class="text-primary small text-decoration-none"
                                href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit"
                                class="btn btn-primary shadow-sm px-4 py-2 fw-semibold"
                                id="loginButton">
                            Log in
                        </button>
                    </div>
                </form>

                <div class="mt-4 pt-3 text-center border-top">
                    <p class="text-muted small mb-3">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 py-2 fw-semibold">
                        Create New Account
                    </a>
                </div>

                <p class="text-center text-muted small mt-4 pt-2 border-top">
                    By signing in, you agree to our <a href="#" class="text-primary">Terms</a> &
                    <a href="#" class="text-primary">Privacy Policy</a>.
                </p>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
