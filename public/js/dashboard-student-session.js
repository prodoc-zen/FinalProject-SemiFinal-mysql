let bookingId = null;

function filterTutors() {
    let input = document.getElementById("tutorSearchInput").value.toLowerCase();
    let selectedSubject = document.getElementById("subjectFilter").value.toLowerCase();
    let tutors = document.querySelectorAll(".tutor-container");

    tutors.forEach(tutor => {
        let name = tutor.querySelector(".tutor-name")?.textContent.toLowerCase() || "";
        let subject = tutor.querySelector(".tutor-subject")?.textContent.toLowerCase() || "";

        let matchesSearch = name.includes(input) || subject.includes(input);
        let matchesSubject = name.includes(selectedSubject) || subject.includes(selectedSubject);

        if (matchesSearch && matchesSubject) {
            tutor.style.display = "block";
        } else {
            tutor.style.display = "none";
        }
    });
}

document.addEventListener('DOMContentLoaded', function () 
{
    const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
    const completeModal = new bootstrap.Modal(document.getElementById('completeModal'));
    
    let currentActionDetails = {};

    // Show Cancel Modal
    window.showCancelModal = function(tutorName, topic, time, bookingIdParam) {
        currentActionDetails = { type: 'cancel', tutorName, topic, time };
        document.getElementById('modalCancelTutorName').textContent = tutorName;
        document.getElementById('modalCancelSessionTopic').textContent = topic;
        document.getElementById('modalCancelSessionTime').textContent = time;
        bookingId = bookingIdParam;
        
        cancelModal.show();
    };

    // Show Complete Modal
    window.showCompleteModal = function(tutorName, topic, time, bookingIdParam) {
        currentActionDetails = { type: 'complete', tutorName, topic, time };
        document.getElementById('modalCompleteTutorName').textContent = tutorName;
        document.getElementById('modalCompleteSessionTopic').textContent = topic;
        document.getElementById('modalCompleteSessionTime').textContent = time;
        document.getElementById('completeBookingId').value = bookingIdParam;

        completeModal.show();
    };

    // Confirm Cancel
    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        if (currentActionDetails.type === 'cancel') {
            console.log(`SESSION CANCELLATION CONFIRMED: Tutor: ${currentActionDetails.tutorName}, Topic: ${currentActionDetails.topic}, Time: ${currentActionDetails.time}`);
            cancelModal.hide();
        }
    });

    // Confirm Complete
    document.getElementById('confirmCompleteBtn').addEventListener('click', function() {
        if (currentActionDetails.type === 'complete') {
            
            document.getElementById('completeSessionForm').submit();
            completeModal.hide();
        }
    });
    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
        if (currentActionDetails.type === 'cancel') {
            // Set the hidden form input
            document.getElementById('cancel_booking_id').value = bookingId;
            // Submit the form
            document.getElementById('cancelBookingForm').submit();
        }
    });
});


