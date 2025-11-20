<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorMatch | Create Your Account</title>
    <!-- Load Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Load Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container-fluid container-lg px-4">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center me-auto" href="#">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width: 24px; height: 24px; background-color: var(--bs-primary);">T</div>
                <span class="fs-5 fw-bold text-dark">TutorMatch</span>
            </a>
            
            <!-- Mobile Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-3 mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-lg shadow-sm">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid p-0 d-flex flex-grow-1">
        <div class="row g-0 flex-grow-1">
            <!-- Left Visual -->
            <div class="col-lg-6 d-none d-lg-flex auth-background">
                <div class="auth-content">
                    <i class="fas fa-graduation-cap fa-3x mb-4 opacity-75"></i>
                    <h2 class="fs-2 fw-semibold mb-4">Join TutorMatch Today</h2>
                    <ul class="auth-list">
                        <li><i class="fas fa-check-circle"></i>Connect with qualified tutors in various subjects.</li>
                        <li><i class="fas fa-check-circle"></i>Flexible scheduling that fits your lifestyle.</li>
                        <li><i class="fas fa-check-circle"></i>Personalized one-on-one learning sessions.</li>
                    </ul>
                </div>
            </div>

            <!-- Right Form -->
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="card p-4 p-md-5 shadow-lg border-0 rounded-3" style="max-width: 450px; width: 90%;">
                    <!-- Dynamic Title & Subtitle -->
                    <h3 class="fs-4 fw-bold text-dark mb-2" id="formTitle">Student Registration</h3>
                    <p class="text-muted small mb-4" id="formSubtitle">Create your account to start booking tutoring sessions.</p>

                    <!-- Role Selector -->
                    <div class="mb-4">
                        <p class="fw-semibold small text-dark mb-2">I want to join as</p>
                        <div class="d-flex justify-content-around role-selector" id="roleSelector">
                            <div class="role-selector-item active" data-role="student">
                                <i class="fas fa-user-graduate me-1"></i> Student
                            </div>
                            <div class="role-selector-item" data-role="tutor">
                                <i class="fas fa-chalkboard-teacher me-1"></i> Tutor
                            </div>
                        </div>
                    </div>

                    <!-- Blade Registration Form -->
                    <form method="POST" action="{{ route('register') }}" id="mainRegisterForm">
                        @csrf
                        <!-- Hidden field to pass role -->
                        <input type="hidden" name="role" id="roleInput" value="student">

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold small text-dark">Full Name</label>
                            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small text-dark">Email Address</label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="student@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4 mb-3">
                            <label for="password" class="form-label fw-semibold small text-dark">Password</label>
                            <input id="password" class="form-control" type="password" name="password" required placeholder="Create a secure password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold small text-dark">Confirm Password</label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="Re-enter password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-primary rounded-lg shadow-sm px-4 py-2 fw-semibold w-100" id="submitButton">
                                Create Student Account &rarr;
                            </button>
                        </div>
                    </form>

                    <!-- Sign In Link -->
                    <div class="mt-4 pt-3 text-center border-top">
                        <p class="text-muted small mb-3">Already have an account?</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-lg px-4 py-2 fw-semibold w-100">Sign In Instead</a>
                    </div>

                    <p class="text-center text-muted small mt-4 pt-2 border-top">
                        By creating an account, you agree to our <a href="#" class="text-primary text-decoration-none">Terms of Service</a> and <a href="#" class="text-primary text-decoration-none">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Role Selector Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const roleSelector = document.getElementById('roleSelector');
            const formTitle = document.getElementById('formTitle');
            const formSubtitle = document.getElementById('formSubtitle');
            const submitButton = document.getElementById('submitButton');
            const roleInput = document.getElementById('roleInput');

            const roleDetails = {
                student: {
                    title: 'Student Registration',
                    subtitle: 'Create your account to start booking tutoring sessions.',
                    buttonText: 'Create Student Account &rarr;'
                },
                tutor: {
                    title: 'Tutor Registration',
                    subtitle: 'Share your expertise and start earning.',
                    buttonText: 'Create Tutor Account &rarr;'
                }
            };

            function updateForm(role) {
                const detail = roleDetails[role];
                if(formTitle) formTitle.textContent = detail.title;
                if(formSubtitle) formSubtitle.textContent = detail.subtitle;
                submitButton.innerHTML = detail.buttonText;
                roleInput.value = role;
            }

            roleSelector.addEventListener('click', (event) => {
                const item = event.target.closest('.role-selector-item');
                if (!item) return;
                const newRole = item.getAttribute('data-role');
                roleSelector.querySelectorAll('.role-selector-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                updateForm(newRole);
            });

            // Initialize default role
            updateForm('student');
        });
    </script>
</body>
</html>
