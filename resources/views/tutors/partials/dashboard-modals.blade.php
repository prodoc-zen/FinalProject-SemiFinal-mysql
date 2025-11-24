 <!-- Custom Modal for ACCEPT REQUEST Confirmation -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 px-4 text-center">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark mb-3">Accept Request?</h5>
                    <p class="text-muted mb-4">Are you sure you want to accept the session request from <span class="fw-semibold text-dark" id="modalAcceptStudentName"></span> for <span class="fw-semibold text-dark" id="modalAcceptSubject"></span>?</p>
                    <p class="small text-success fw-semibold">This will move the session to your Upcoming Schedule.</p>
                </div>
                <div class="modal-footer border-0 p-4 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success rounded-3 text-white" id="confirmAcceptBtn" style="background-color: var(--bs-primary); border-color: var(--bs-primary);">Yes, Accept Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- NEW Custom Modal for REJECT REQUEST Confirmation -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 px-4 text-center">
                    <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                    <h5 class="fw-bold text-dark mb-3">Reject Request?</h5>
                    <p class="text-muted mb-4">Are you sure you want to reject the session request from <span class="fw-semibold text-dark" id="modalRejectStudentName"></span>?</p>
                    <p class="small text-danger fw-semibold">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0 p-4 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger rounded-3 text-white" id="confirmRejectBtn">Yes, Reject Request</button>
                </div>
            </div>
        </div>
    </div>

    





 <!-- 1. CANCEL SESSION CONFIRMATION MODAL -->
    <div class="modal fade" id="cancelSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 px-4 text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5 class="fw-bold text-dark mb-3">Cancel Session?</h5>
                    <p class="text-muted mb-4">Are you sure you want to cancel the session with <span class="fw-bold text-dark" id="modalCancelStudentName"></span>?</p>
                    <p class="small text-danger fw-semibold">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0 p-4 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Go Back</button>
                    <button type="button" class="btn btn-danger rounded-3 text-white" id="confirmCancelSessionBtn">Yes, Cancel Session</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. COMPLETE SESSION CONFIRMATION MODAL -->
    <div class="modal fade" id="completeSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 px-4 text-center">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark mb-3">Complete Session?</h5>
                    <p class="text-muted mb-4">Confirm that the session with <span class="fw-bold text-dark" id="modalCompleteStudentName"></span> for <span class="fw-bold text-dark" id="modalCompleteSubject"></span> was successful.</p>
                    <p class="small text-success fw-semibold">This will mark the session as finished.</p>
                </div>
                <div class="modal-footer border-0 p-4 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <!-- Inline style to ensure primary color override -->
                    <button type="button" class="btn btn-primary rounded-3 text-white" id="confirmCompleteSessionBtn" style="background-color: var(--bs-primary); border-color: var(--bs-primary);">Yes, Complete Session</button>
                </div>
            </div>
        </div>
    </div>

    <form id="completeSessionForm" action="{{ route('booking.complete') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="booking_id" id="completeSessionId">
    </form>

    <form id="acceptRequestForm" action="{{ route('booking.accept') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="booking_id" id="hiddenRequestId">
    </form>

    <form id="rejectRequestForm" action="{{ route('booking.reject') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="booking_id" id="rejectRequestId">
    </form>

    <form id="cancelSessionForm" action="{{ route('booking.reject') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="booking_id" id="cancelBookingId">
    </form>





   