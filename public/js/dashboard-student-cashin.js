document.addEventListener('DOMContentLoaded', () => {

            // 5. Cash In Modal Logic
            const cashInModal = new bootstrap.Modal(document.getElementById('cashInModal'));
            window.openCashInModal = function() {
                cashInModal.show();
            };
            

        });