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
                                <h2 class="display-5 fw-bold text-dark mb-0">{{$totalSessions}}</h2>
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
                                <h2 class="display-5 fw-bold text-dark mb-0">{{$upcomingSessions}}</h2>
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
                                <h2 class="display-5 fw-bold text-dark mb-0">{{$activeSubjects}}</h2>
                                <p class="small text-muted mb-0">Math, Physics</p>
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
                            <h4 class="fw-semibold text-white mb-2">{{$nextSession?->subject?->name ?? 'No upcoming sessions'}}</h4>
                            <p class="mb-1 fw-light"><i class="fas fa-user-circle me-2"></i> Tutor: {{ $nextSession->tutor?->user?->name ?? 'No Tutor Assigned' }}</p>
                            <p class="mb-1 fw-light"><i class="fas fa-clock me-2"></i> Date/Time: {{ $nextSession->scheduled_at ?? 'N/A' }}</p>
                         
                            <p class="mt-4 fw-semibold small text-white opacity-75">
                                Session details and the join link will be available closer to the appointment time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>