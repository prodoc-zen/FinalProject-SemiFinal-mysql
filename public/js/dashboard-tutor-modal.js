
document.addEventListener('DOMContentLoaded', () => {

            // --- Accept Modal Logic ---
            const acceptModalElement = document.getElementById('acceptModal');
            const acceptModal = new bootstrap.Modal(acceptModalElement);
            let currentActionDetails = {};

            window.showAcceptModal = function(studentName, subject, pendingId) {
                currentActionDetails = { type: 'accept', studentName, subject };
                document.getElementById('modalAcceptStudentName').textContent = studentName;
                document.getElementById('modalAcceptSubject').textContent = subject;
                document.getElementById('hiddenRequestId').value = pendingId;

                acceptModal.show();
            };

            document.getElementById('confirmAcceptBtn').addEventListener('click', function() {
                 console.log(`REQUEST ACCEPTED: Student: ${currentActionDetails.studentName}, Subject: ${currentActionDetails.subject}`);
                 acceptModal.hide();
            });

            // --- Reject Modal Logic ---
            const rejectModalElement = document.getElementById('rejectModal');
            const rejectModal = new bootstrap.Modal(rejectModalElement);

            window.showRejectModal = function(studentName, subject, pendingId) {
                currentActionDetails = { type: 'reject', studentName, subject };
                document.getElementById('modalRejectStudentName').textContent = studentName;
                document.getElementById('rejectRequestId').value = pendingId;
                alert(document.getElementById('rejectRequestId').value);
                rejectModal.show();
            };

            document.getElementById('confirmRejectBtn').addEventListener('click', function() {
                 console.log(`REQUEST REJECTED: Student: ${currentActionDetails.studentName}, Subject: ${currentActionDetails.subject}`);
                 rejectModal.hide();
            });

            //submit form on confirm
            document.getElementById("confirmAcceptBtn").addEventListener("click", function () {
                
                document.getElementById("acceptRequestForm").submit();
            });

            //cancel or reject form on confirm
            document.getElementById("confirmRejectBtn").addEventListener("click", function () {
                alert(document.getElementById('rejectRequestId').value);
                document.getElementById("rejectRequestForm").submit();
                
            });


            // 1. Cancel Session Modal
            const cancelSessionModal = new bootstrap.Modal(document.getElementById('cancelSessionModal'));
            window.showCancelModal = function(studentName, subject, sessionId) {
                currentActionDetails = { type: 'cancelSession', studentName, subject };
                document.getElementById('modalCancelStudentName').textContent = studentName;
                document.getElementById('cancelBookingId').value = sessionId;


                cancelSessionModal.show();
            };
            document.getElementById("confirmCancelSessionBtn").addEventListener("click", function () {

                document.getElementById("cancelSessionForm").submit();
            });


            // 2. Complete Session Modal
            const completeSessionModal = new bootstrap.Modal(document.getElementById('completeSessionModal'));
            window.showCompleteModal = function(studentName, subject, sessionId) {
                currentActionDetails = { type: 'completeSession', studentName, subject };
                document.getElementById('modalCompleteStudentName').textContent = studentName;
                document.getElementById('modalCompleteSubject').textContent = subject;
                document.getElementById('completeSessionId').value = sessionId;
                
                completeSessionModal.show();
            };
            document.getElementById('confirmCompleteSessionBtn').addEventListener('click', function() {
                console.log(`SESSION COMPLETED: ${currentActionDetails.studentName}`);
                completeSessionModal.hide();
            });

            //submit form on confirm
            document.getElementById("confirmCompleteSessionBtn").addEventListener("click", function () 
            {
                alert(document.getElementById('completeSessionId').value);
                document.getElementById("completeSessionForm").submit();
            });

            document.getElementById("confirmCompleteBtn").addEventListener("click", function () {
                
                console.log(document.getElementById("completeBookingId").value);
                
                document.getElementById("completeSessionForm").submit();
            });



        });