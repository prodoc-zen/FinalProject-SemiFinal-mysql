<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow-lg">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-0 px-4">
                            <h4 class="fw-bold text-dark mb-1" id="bookingModalTitle">Book a Session</h4>
                            <p class="text-muted mb-4" id="bookingModalSubtitle">Schedule your tutoring session.</p>

                            <div class="row booking-modal-content">
                                <!-- Left Column: Calendar & Date Picker -->
                                <div class="col-12 col-md-7">
                                    <h6 class="fw-bold text-dark mb-3">Select Date</h6>
                                    <div class="p-3 border rounded-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <button class="btn btn-sm btn-light p-0" id="prevMonthBtn"><i class="fas fa-chevron-left text-primary"></i></button>
                                            <span class="fw-bold text-primary" id="currentMonthYear"></span>
                                            <button class="btn btn-sm btn-light p-0" id="nextMonthBtn"><i class="fas fa-chevron-right text-primary"></i></button>
                                        </div>
                                        <div class="calendar-grid mb-3" id="calendarGridHeader">
                                            <span class="calendar-weekday day-weekday">Su</span>
                                            <span class="calendar-weekday day-weekday">Mo</span>
                                            <span class="calendar-weekday day-weekday">Tu</span>
                                            <span class="calendar-weekday day-weekday">We</span>
                                            <span class="calendar-weekday day-weekday">Th</span>
                                            <span class="calendar-weekday day-weekday">Fr</span>
                                            <span class="calendar-weekday day-weekday">Sa</span>
                                        </div>
                                        <div class="calendar-grid" id="calendarGridBody">
                                            <!-- Calendar days will be generated here by JavaScript -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Time Selection & Summary -->
                                <div class="col-12 col-md-5">
                                    <h6 class="fw-bold text-dark mb-3">Time and Duration</h6>

                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label for="startTimeInput" class="form-label small text-muted mb-1">Start Time</label>
                                            <input type="time" id="startTimeInput" class="form-control rounded-3" value="10:00" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="durationSelect" class="form-label small text-muted mb-1">Duration</label>
                                            <select id="durationSelect" class="form-select rounded-3" required>
                                                <option value="" disabled>Select Duration</option>
                                                <option value="30">30 minutes</option>
                                                <option value="60" selected>60 minutes (1 hour)</option>
                                                <option value="90">90 minutes (1.5 hours)</option>
                                                <option value="120">120 minutes (2 hours)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Summary -->
                                    <div class="small p-3 bg-light rounded-3">
                                        <h6 class="fw-bold mb-3 text-primary">Booking Summary</h6>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Hourly Rate:</span>
                                            <span class="fw-semibold text-dark" id="summaryHourlyRate">N/A</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Date:</span>
                                            <span class="fw-semibold text-dark" id="summaryBookingDate">N/A</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Start Time:</span>
                                            <span class="fw-semibold text-dark" id="summaryStartTime">N/A</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                            <span class="text-muted">End Time:</span>
                                            <span class="fw-semibold text-dark" id="summaryEndTime">N/A</span>
                                        </div>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span class="text-dark">Total Price:</span>
                                            <span class="text-dark" id="summaryTotalPrice">N/A</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-danger small text-end fw-semibold" id="timeError" style="display: none;">
                                        Please select a date, start time, and duration.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                            {{-- <button type="button" class="btn btn-primary rounded-3" id="confirmBookingBtn" disabled>Confirm Booking</button> --}}

                            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="student_id" id="student_id">
                                <input type="hidden" name="tutor_id" id="tutor_id">
                                <input type="hidden" name="subject_id" id="subject_id">
                                <input type="hidden" name="scheduled_at" id="scheduled_at">
                                <input type="hidden" name="duration_minutes" id="duration_minutes">
                                <input type="hidden" name="status" id="status" value="pending">
                                
                            </form>

                            <button type="submit" class="btn btn-primary rounded-3" id="confirmBookingBtn" disabled>
                                    Confirm Booking
                            </button>

                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal for Sessions ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

            <!-- Cancel Session Modal -->
            <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="cancelModalLabel">Cancel Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this session?</p>
                    <p><strong>Tutor:</strong> <span id="modalCancelTutorName"></span></p>
                    <p><strong>Topic:</strong> <span id="modalCancelSessionTopic"></span></p>
                    <p><strong>Time:</strong> <span id="modalCancelSessionTime"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">No, Keep</button>
                    

                    <button type="submit" class="btn btn-danger rounded-3" id="confirmCancelBtn" form="cancelBookingForm">Yes, Cancel</button>
                </div>
                </div>
            </div>
            </div>

            
            <form id="cancelBookingForm" action="{{ route('booking.cancel') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="booking_id" id="cancel_booking_id">
            </form>


            <!-- Complete Session Modal -->
            <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="completeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="completeModalLabel">Complete Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark this session as complete?</p>
                    <p><strong>Tutor:</strong> <span id="modalCompleteTutorName"></span></p>
                    <p><strong>Topic:</strong> <span id="modalCompleteSessionTopic"></span></p>
                    <p><strong>Time:</strong> <span id="modalCompleteSessionTime"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-3" id="confirmCompleteBtn">Confirm Completion</button>
                </div>
                </div>
            </div>
            </div>

            <form id="completeSessionForm" action="{{ route('booking-student.complete') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" id="completeBookingId">
            </form>


