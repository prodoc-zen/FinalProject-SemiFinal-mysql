<main class="content-area" id="mainContentArea">
            

            <!-- 5. MY SESSIONS VIEW CONTENT (Now explicitly hidden) -->
            
            
            <!-- 6. REQUESTS VIEW CONTENT (This is the default view now) -->
            <div id="requestsView">
                <div class="mb-5">
                    <h2 class="fw-bolder fs-3">Session Requests History</h2>
                    <p class="text-muted lead-sm">Manage new requests and view the history of past requests.</p>
                </div>

                <!-- Bootstrap Tab Navigation -->
                <ul class="nav nav-tabs" id="requestTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pendingRequests" type="button" role="tab">
                            <i class="fas fa-hourglass-start me-2"></i> Pending
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completedRequests" type="button" role="tab">
                            <i class="fas fa-check-circle me-2"></i> Completed
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceledRequests" type="button" role="tab">
                            <i class="fas fa-times-circle me-2"></i> Canceled
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content pt-3" id="requestTabContent">
                    
                   
                    <!-- PENDING Requests Tab -->
                    <div class="tab-pane fade show active" id="pendingRequests" role="tabpanel">
                        <p class="text-muted small mb-3">Requests that require your acceptance or rejection.</p>
                        <div class="sessions-list">
                             @foreach($pending_bookings as $pending_booking)
                            <!-- PENDING ITEM 1 (Yellow border, action buttons) -->
                            <div class="session-item status-pending">
                                <div class="session-info">
                                    <h4 class="fw-bold mb-0">{{ $pending_booking->subject->name ?? 'No Subject' }}</h4>
                                    <p class="student-name mb-1">Student: {{ $pending_booking->student->user->name ?? 'No Student' }}</p>
                                    <div class="time-location">
                                        <i class="fas fa-calendar-day"></i> {{ $pending_booking->scheduled_at ?? 'No Date' }} (Online)
                                    </div>
                                    <div class="time-location">
                                        <i class="fas fa-dollar-sign"></i> {{ number_format($pending_booking->cost ?? 0, 2) }}
                                    </div>

                                    @php
                                        $hours = intdiv($pending_booking->duration_minutes ?? 0, 60);
                                        $minutes = ($pending_booking->duration_minutes ?? 0) % 60;
                                    @endphp

                                    <div class="time-location">
                                        <i class="fas fa-clock"></i> 
                                        {{ $hours > 0 ? $hours . ' hr ' : '' }}{{ $minutes > 0 ? $minutes . ' min' : '' }}
                                    </div>

                                </div>
                                
                                <div class="session-actions">
                                    <button class="btn btn-primary" onclick="showAcceptModal('{{ $pending_booking->student->user->name ?? 'No Student' }}', '{{ $pending_booking->subject->name ?? 'No Subject' }}', '{{ $pending_booking->id }}')"><i class="fas fa-check mr-2"></i> Accept</button>
                                    <button class="btn btn-outline-danger" onclick="showRejectModal('{{ $pending_booking->student->user->name ?? 'No Student' }}', '{{ $pending_booking->subject->name ?? 'No Subject' }}', '{{ $pending_booking->id }}')"><i class="fas fa-times mr-2"></i> Reject</button>


                                </div>
                            </div>
                             @endforeach
                            
                        </div>
                    </div>
                   
                    
                    <!-- COMPLETED Requests Tab -->
                    <div class="tab-pane fade" id="completedRequests" role="tabpanel">
                        <p class="text-muted small mb-3">Successfully completed or confirmed requests.</p>
                        <div class="sessions-list">
                            @foreach($completed_bookings as $completed_booking)
                             <!-- COMPLETED ITEM 1 (Blue border, badge only) -->
                            <div class="session-item status-completed">
                                <div class="session-info">
                                    <h4 class="fw-bold mb-0">{{ $completed_booking->subject->name ?? 'No Subject' }}</h4>
                                    <p class="student-name mb-1">Student: {{ $completed_booking->student->user->name ?? 'No Student' }}</p>
                                    <div class="time-location">
                                        <i class="fas fa-calendar-day"></i> {{ $completed_booking->scheduled_at ?? 'No Date' }} (Online)
                                    </div>
                                </div>
                                
                                <div class="session-actions">
                                    <span class="status-badge completed">COMPLETED</span>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    
                    <!-- CANCELED Requests Tab -->
                    <div class="tab-pane fade" id="canceledRequests" role="tabpanel">
                        <p class="text-muted small mb-3">Requests that were rejected by you or canceled by the student.</p>
                        <div class="sessions-list">
                            @foreach($canceled_bookings as $canceled_booking)
                            <div class="session-item status-canceled">
                                <div class="session-info">
                                    <h4 class="fw-bold mb-0">{{ $canceled_booking->subject->name ?? 'No Subject' }}</h4>
                                    <p class="student-name mb-1">Student: {{ $canceled_booking->student->user->name ?? 'No Student' }}</p>
                                    <div class="time-location">
                                        <i class="fas fa-calendar-day"></i> {{ $canceled_booking->scheduled_at ?? 'No Date' }} (Online)
                                    </div>
                                </div>
                                
                                <div class="session-actions">
                                    <span class="status-badge canceled">CANCELED</span>
                                </div>
                            </div>
                                @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>

            

        </main>