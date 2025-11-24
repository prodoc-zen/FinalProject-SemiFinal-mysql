 <main class="content-area" id="mainContentArea">
            <div class="mb-5">
                <h2 class="fw-bolder fs-3">Welcome back, {{ Auth::user()->name }}</h2>
                <p class="text-muted lead-sm">Ready to help your students succeed? Here's your tutoring overview.</p>
            </div>

            <div class="row g-4">
                
                <div class="col-sm-6 col-lg-4">
                    <div class="stat-card h-100">
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
                
                <div class="col-sm-6 col-lg-4">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Pending Requests</p>
                                <h2 class="display-5 fw-bold text-dark mb-0">{{$upcomingSessions}}</h2>
                                <p class="small text-muted mb-0">Awaiting your approval</p>
                            </div>
                            <div class="icon-circle" style="background-color:#ffc107; box-shadow: 0 4px 8px rgba(255, 193, 7, 0.4);"><i class="fas fa-hourglass-start"></i></div>
                        </div>
                    </div>
                </div>
                
                <!-- Total Earnings Card -->
                <div class="col-sm-6 col-lg-4">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small text-uppercase">Total Earnings</p>
                                <!-- Font size will dynamically shrink very aggressively as the available width decreases -->
                                <h2 class="display-5 fw-bold text-dark mb-0">$23</h2>
                                <p class="small text-muted mb-0">Paid out this month</p>
                            </div>
                            <div class="icon-circle" style="background-color:#28a745; box-shadow: 0 4px 8px rgba(40, 167, 69, 0.4);"><i class="fas fa-dollar-sign"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row g-4 mt-4">
                <div class="col-12">
                    <div class="card p-4 rounded-3 shadow-lg next-session-card h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-check fa-2x me-3 opacity-75"></i>
                            <h3 class="fs-4 fw-bold mb-0">Your Next Session</h3>
                        </div>
                        <div class="card-body p-0">
                            <h4 class="fw-semibold text-white mb-2">{{$nextSession->subject->name ?? 'N/A'}}</h4>
                            <p class="mb-1 fw-light"><i class="fas fa-user-circle me-2"></i> Student: {{$nextSession->student->user->name ?? 'N/A'}}</p>
                            <p class="mb-1 fw-light"><i class="fas fa-clock me-2"></i> {{ $nextSession->scheduled_at ?? 'N/A' }}</p>
                            
                            <p class="mt-4 fw-semibold small text-white opacity-75">
                                Ensure you have the session materials ready and join the link five minutes early.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </main>