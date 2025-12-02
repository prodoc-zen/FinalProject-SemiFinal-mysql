<main class="content-area" id="mainContentArea">
    <!-- MY SESSIONS CONTENT START -->
    <div class="container-fluid px-0">
        <h1 class="h2 fw-bold mb-0 text-dark">Upcoming Sessions</h1>
        <p class="text-muted lead-sm">Review your confirmed, upcoming one-on-one sessions with students.</p>

        <div class="tab-content" id="sessionTabsContent">
            
            <!-- Upcoming Sessions Tab -->
            <div class="tab-pane fade show active mt-5" id="upcoming-sessions" role="tabpanel" aria-labelledby="upcoming-tab">
                <div class="sessions-list">
                    
                    @forelse($confirmed_bookings as $confirmed_booking)
                        <div class="session-item">
                            <div class="session-info">
                                <h4 class="fw-bold mb-0">{{$confirmed_booking->subject->name}}</h4>
                                <p class="student-name mb-1">Student: {{$confirmed_booking->student->user->name}}</p>
                                <div class="time-location">
                                    <i class="fas fa-calendar-day"></i> {{$confirmed_booking->scheduled_at}} (Online)
                                </div>
                            </div>
                            <div class="me-3">
                                <a href="
                                    @if(auth()->user()->role === 'student')
                                        {{ route('chat.open', ['booking_id' => $confirmed_booking->id]) }}
                                    @else
                                        {{ route('tutor.chat.open', ['booking_id' => $confirmed_booking->id]) }}
                                    @endif
                                " class="btn btn-outline-secondary border-0 text-gray-600 hover:bg-gray-100 p-2 rounded-full">
                                    <i class="fas fa-comments text-xl"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-end flex-wrap gap-1 session-actions">
                                <button class="btn btn-primary" onclick="showCompleteModal('{{$confirmed_booking->student->user->name}}', '{{$confirmed_booking->subject->name}}', {{$confirmed_booking->id}})"><i class="fas fa-check-circle mr-2"></i> Complete Session</button>
                            
                                <button class="btn btn-outline-danger" onclick="showCancelModal('{{$confirmed_booking->student->user->name}}', '{{$confirmed_booking->subject->name}}', {{$confirmed_booking->id}})"><i class="fas fa-times mr-2"></i> Cancel</button>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted lead-sm">No confirmed bookings found.</p>
                    @endforelse
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




