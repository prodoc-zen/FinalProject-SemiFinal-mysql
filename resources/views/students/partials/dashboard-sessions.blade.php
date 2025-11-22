
<main class="content-area" id="mainContentArea">
            
            <!-- MY SESSIONS CONTENT START -->
            <div class="container-fluid px-0">
                <h1 class="h2 fw-bold mb-5 text-dark">My Sessions</h1>

                <!-- Tabs for filtering sessions -->
                <ul class="nav nav-tabs mb-4" id="sessionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming-sessions" type="button" role="tab">Upcoming (3)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-sessions" type="button" role="tab">Completed (4)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled-sessions" type="button" role="tab">Cancelled (1)</button>
                    </li>
                </ul>

                <div class="tab-content" id="sessionTabsContent">
                    
                    <!-- Upcoming Sessions Tab -->
                    <div class="tab-pane fade show active" id="upcoming-sessions" role="tabpanel" aria-labelledby="upcoming-tab">
                        <div class="row g-4" id="upcomingSessionsList">
                            
                            @foreach($confirmed_bookings as $session)
                                <!-- Upcoming Session Card: CONFIRMED -->
                                <div class="col-12 col-lg-6">
                                    <div class="session-card shadow-sm">
                                        <div class="session-header p-3 d-flex justify-content-between align-items-center">
                                            <span class="session-status status-upcoming">UPCOMING</span>
                                            <span class="text-muted small"><i class="fas fa-calendar-check me-1 text-primary"></i> Confirmed</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="d-flex gap-3 mb-3 align-items-center">
                                                <div class="tutor-icon-box"><i class="fas fa-calculator"></i></div>
                                                <div>
                                                    <h5 class="fw-bold mb-0 text-dark">{{ $session->tutor->name }}</h5>
                                                    <p class="text-sm fw-semibold text-primary mb-0">{{ $session->subject->name }}</p>
                                                </div>
                                            </div>
                                            <div class="row small g-2 mb-4">
                                                @php
                                                    $start = \Carbon\Carbon::parse($session->scheduled_at);
                                                    $end = $start->copy()->addMinutes($session->duration_minutes);
                                                @endphp
                                                <div class="col-6"><i class="fas fa-calendar me-2 text-muted"></i> Date: <span class="fw-semibold">{{ $start->format('l, M j, Y') }}</span></div>
                                                <div class="col-6"><i class="fas fa-clock me-2 text-muted"></i> Time: <span class="fw-semibold">{{ $start->format('g:i A') }} - {{ $end->format('g:i A') }}</span></div>
                                                <div class="col-6"><i class="fas fa-dollar-sign me-2 text-muted"></i> Total Cost: <span class="fw-semibold">${{ number_format($session->total_cost, 2) }}</span></div>
                                                <div class="col-6"><i class="fas fa-history me-2 text-muted"></i> Duration: <span class="fw-semibold">{{ $session->duration_minutes }} min</span></div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <!-- Complete & Cancel Actions -->
                                                <button class="btn btn-primary me-2" onclick="showCompleteModal('{{ $session->tutor->name }}', '{{ $session->subject->name }}', '{{ $start->format('M j, Y \a\t g:i A') }}')">
                                                    <i class="fas fa-check-circle me-1"></i> Complete Session
                                                </button>
                                                <button class="btn btn-outline-danger" onclick="showCancelModal('{{ $session->tutor->name }}', '{{ $session->subject->name }}', '{{ $start->format('M j, Y \a\t g:i A') }}')">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            
                            @foreach($pending_bookings as $session)
                                <!-- Upcoming Session Card 2: PENDING (ACTION: Cancel Request) -->
                                <div class="col-12 col-lg-6">
                                    <div class="session-card shadow-sm border-warning">
                                        <div class="session-header p-3 d-flex justify-content-between align-items-center">
                                            <span class="session-status status-pending">PENDING</span>
                                            <span class="text-muted small"><i class="fas fa-hourglass-half me-1 text-warning"></i> Awaiting Tutor Approval</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="d-flex gap-3 mb-3 align-items-center">
                                                <div class="tutor-icon-box" style="background-color: rgba(255, 193, 7, 0.1); color: #ffc107;"><i class="fas fa-lightbulb"></i></div>
                                                <div>
                                                    <h5 class="fw-bold mb-0 text-dark">{{ $session->tutor->user->name }}</h5>
                                                    <p class="text-sm fw-semibold text-warning mb-0">{{ $session->subject->name }}</p>
                                                </div>
                                            </div>
                                            <div class="row small g-2 mb-4">
                                                @php
                                                    $start = \Carbon\Carbon::parse($session->scheduled_at);
                                                    $end = $start->copy()->addMinutes($session->duration_minutes);
                                                @endphp
                                                <div class="col-6"><i class="fas fa-calendar me-2 text-muted"></i> Date: <span class="fw-semibold">{{ $start->format('l, M j, Y') }}</span></div>
                                                <div class="col-6"><i class="fas fa-clock me-2 text-muted"></i> Time: <span class="fw-semibold">{{ $start->format('g:i A') }} - {{ $end->format('g:i A') }}</span></div>
                                                <div class="col-6"><i class="fas fa-dollar-sign me-2 text-muted"></i> Total Cost: <span class="fw-semibold">${{ number_format($session->total_cost, 2) }}</span></div>
                                                <div class="col-6"><i class="fas fa-history me-2 text-muted"></i> Duration: <span class="fw-semibold">{{ $session->duration_minutes }} min</span></div>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center">
                                                <!-- Action for Pending Session -->
                                                <span class="badge bg-warning text-dark me-3 py-2 px-3 fw-semibold">Pending Confirmation</span>
                                                <button class="btn btn-outline-danger" 
                                                        onclick="showCancelModal(
                                                            '{{ $session?->tutor?->user?->name ?? 'No name' }}', 
                                                            '{{ $session->subject->name }}', 
                                                            '{{ \Carbon\Carbon::parse($session->scheduled_at)->format('M j, Y \a\t g:i A') }}',
                                                            '{{ $session->id ?? 0 }}'
                                                        )" 
                                                        data-booking-id="{{ $session->id ?? 0 }}">
                                                    <i class="fas fa-times me-1"></i> Cancel Request
                                                </button>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                                
                            </div>
                        </div>
                    
                    <!-- Completed Sessions Tab -->
                    <div class="tab-pane fade" id="completed-sessions" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="row g-4">
                           
                            @foreach($completed_bookings as $session)
                                <div class="col-12 col-lg-6">
                                    <div class="session-card shadow-sm">
                                        <div class="session-header p-3 d-flex justify-content-between align-items-center">
                                            <span class="session-status status-completed">COMPLETED</span>
                            
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="d-flex gap-3 mb-3 align-items-center">
                                                <div class="tutor-icon-box"><i class="fas fa-code"></i></div>
                                                <div>
                                                    <h5 class="fw-bold mb-0 text-dark">{{ $session->tutor->user->name ?? 'Unknown Tutor' }}</h5>
                                                    <p class="text-sm fw-semibold text-primary mb-0">{{ $session->subject->name ?? 'Unknown Subject' }}</p>
                                                </div>
                                            </div>
                                            <div class="row small g-2">
                                                <div class="col-6"><i class="fas fa-calendar me-2 text-muted"></i> Date: <span class="fw-semibold">{{ \Carbon\Carbon::parse($session->scheduled_at)->format('M j, Y') }}</span></div>
                                                <div class="col-6"><i class="fas fa-clock me-2 text-muted"></i> Time: <span class="fw-semibold">{{ \Carbon\Carbon::parse($session->scheduled_at)->format('g:i A') }} - {{ \Carbon\Carbon::parse($session->scheduled_at)->addMinutes($session->duration)->format('g:i A') }}</span></div>
                                            </div>
                                            <!-- Removed: Book Again button -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>

                    <!-- Cancelled Sessions Tab -->
                    <div class="tab-pane fade" id="cancelled-sessions" role="tabpanel" aria-labelledby="cancelled-tab">
    <div class="row g-4">
        @foreach($canceled_bookings as $session)
            <div class="col-12 col-lg-6">
                <div class="session-card shadow-sm">
                    <div class="session-header p-3 d-flex justify-content-between align-items-center">
                        <span class="session-status status-cancelled">CANCELED</span>
                        <span class="text-danger small"><i class="fas fa-user-times me-1"></i> By Student</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-3 align-items-center">
                            <div class="tutor-icon-box" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;"><i class="fas fa-flask"></i></div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">{{ $session->tutor->user->name }}</h5>
                                <p class="text-sm fw-semibold text-danger mb-0">{{ $session->subject->name }}</p>
                            </div>
                        </div>
                        <div class="row small g-2">
                            <div class="col-6"><i class="fas fa-calendar me-2 text-muted"></i> Original Date: <span class="fw-semibold">{{ \Carbon\Carbon::parse($session->scheduled_at)->format('M d, Y') }}</span></div>
                            <div class="col-6"><i class="fas fa-clock me-2 text-muted"></i> Time: <span class="fw-semibold">{{ \Carbon\Carbon::parse($session->scheduled_at)->format('g:i A') }} - {{ \Carbon\Carbon::parse($session->scheduled_at)->addMinutes($session->duration)->format('g:i A') }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

                </div>

                <!-- Fallback/Empty State -->
                <div id="emptyState" class="alert alert-light text-center p-5 rounded-4 border" role="alert" style="display: none;">
                    <h4 class="alert-heading text-muted"><i class="fas fa-inbox fa-2x mb-2"></i></h4>
                    <p class="mb-0">No active sessions found in this category.</p>
                    <p class="mb-0 small text-muted">Time to check out the <a href="dashboard_tutors.html" class="alert-link text-primary fw-semibold">Browse Tutors</a> page!</p>
                </div>
            </div>
            <!-- MY SESSIONS CONTENT END -->
            
        </main>