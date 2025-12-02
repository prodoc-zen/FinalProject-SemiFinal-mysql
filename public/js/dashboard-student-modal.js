
    function openBookingModal(button) 
    {
        const tutorId = button.dataset.tutorId;
        const subjectId = button.dataset.subjectId;
        const tutorName = button.dataset.tutorName;
        const tutorSubject = button.dataset.tutorSubject;
        const tutorRate = parseFloat(button.dataset.tutorRate, 10);
        const studentId = button.dataset.studentId;

    

    // Update modal titles
    document.getElementById('bookingModalTitle').textContent = `Book a Session with ${tutorName}`;
    document.getElementById('bookingModalSubtitle').textContent = `Schedule a tutoring session for ${tutorSubject}.`;
    document.getElementById('summaryHourlyRate').textContent = `$${tutorRate}/hour`;

    // Default time/duration
    const startTimeInput = document.getElementById('startTimeInput');
    const durationSelect = document.getElementById('durationSelect');
    startTimeInput.value = '10:00';
    durationSelect.value = '60';

    const calendarBody = document.getElementById('calendarGridBody');
    const monthYearHeader = document.getElementById('currentMonthYear');
    const MONTH_NAMES = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    
    let today = new Date();
    let selectedBookingDate = new Date(today.getFullYear(), today.getMonth(), today.getDate()+1);
    let currentMonthDate = new Date(today.getFullYear(), today.getMonth(), 1);

    function formatYMD(date) {
        const y = date.getFullYear();
        const m = (date.getMonth()+1).toString().padStart(2,'0');
        const d = date.getDate().toString().padStart(2,'0');
        return `${y}-${m}-${d}`;
    }

    function renderCalendar() {
        calendarBody.innerHTML = '';
        const year = currentMonthDate.getFullYear();
        const month = currentMonthDate.getMonth();
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        monthYearHeader.textContent = `${MONTH_NAMES[month]} ${year}`;

        for (let i = 0; i < firstDay; i++) {
            const emptyDiv = document.createElement('div');
            calendarBody.appendChild(emptyDiv);
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = d;
            const dateStr = formatYMD(new Date(year, month, d));
            dayDiv.dataset.date = dateStr;
            dayDiv.classList.add('calendar-day');

            if (formatYMD(selectedBookingDate) === dateStr) {
                dayDiv.classList.add('day-selected');
            }

            dayDiv.addEventListener('click', e => {
                const [y, m, d] = e.target.dataset.date.split('-').map(Number);
                const clickedDate = new Date(y, m - 1, d);

                const today = new Date();
                today.setHours(0, 0, 0, 0); // reset to midnight
                let minBookingDate = new Date(today);
                minBookingDate.setDate(minBookingDate.getDate() + 1); // at least next day

                if (clickedDate < minBookingDate) {
                    alert("You must book at least 1 day in advanced.");
                    return; // stop here
                }

                // Select the day visually
                calendarBody.querySelectorAll('.calendar-day').forEach(c => c.classList.remove('day-selected'));
                e.target.classList.add('day-selected');
                selectedBookingDate = clickedDate;

                // ✅ Reset time input if today is selected
                const startTimeInput = document.getElementById('startTimeInput');
                if (clickedDate.getTime() === today.getTime()) {
                    // prevent past times
                    const now = new Date();
                    const safeHour = Math.max(now.getHours(), 10); // default min 10AM
                    const safeMinute = now.getMinutes() < 30 ? 0 : 30; // round to 0 or 30
                    startTimeInput.value = `${safeHour.toString().padStart(2,'0')}:${safeMinute.toString().padStart(2,'0')}`;
                    startTimeInput.min = `${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')}`;
                } else {
                    startTimeInput.value = '10:00';
                    startTimeInput.min = '00:00'; // reset min for future dates
                }

                updateBookingSummary();
            });


            calendarBody.appendChild(dayDiv);
        }
    }

    function prevMonth() {
        currentMonthDate.setMonth(currentMonthDate.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentMonthDate.setMonth(currentMonthDate.getMonth() + 1);
        renderCalendar();
    }

    document.getElementById('prevMonthBtn').onclick = prevMonth;
    document.getElementById('nextMonthBtn').onclick = nextMonth;

    function updateBookingSummary() 
    {
        if (!selectedBookingDate) return;
        const startTime = startTimeInput.value;
        const durationMinutes = parseInt(durationSelect.value);
        if (!startTime || !durationMinutes) return;

        const [h,m] = startTime.split(':').map(Number);
        const startDateTime = new Date(selectedBookingDate.getFullYear(), selectedBookingDate.getMonth(), selectedBookingDate.getDate(), h, m);
        const endDateTime = new Date(startDateTime.getTime() + durationMinutes*60000);

        const formatTime = t => {
            let hours = t.getHours();
            const minutes = t.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            return `${hours}:${minutes.toString().padStart(2,'0')} ${ampm}`;
        };

        document.getElementById('summaryBookingDate').textContent = startDateTime.toLocaleDateString('en-US', {year:'numeric', month:'long', day:'numeric'});
        document.getElementById('summaryStartTime').textContent = formatTime(startDateTime);
        document.getElementById('summaryEndTime').textContent = formatTime(endDateTime);
        document.getElementById('summaryTotalPrice').textContent = `$${((durationMinutes/60)*tutorRate).toFixed(2)}`;
    }

    startTimeInput.onchange = updateBookingSummary;
    durationSelect.onchange = updateBookingSummary;

    renderCalendar();
    updateBookingSummary();

    const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    // Inside your openBookingModal function, after opening modal
    const confirmBtn = document.getElementById('confirmBookingBtn');

    // Store the tutor subject in a data attribute
    confirmBtn.dataset.tutorSubject = tutorSubject; // store the current tutor subject
    confirmBtn.dataset.tutorId = tutorId;
    // Enable the button (optional if you want to enable immediately)
    confirmBtn.disabled = false;

    // Add click listener



    confirmBtn.onclick = () => {
    // Get values from the modal / data attributes
    

    // Get selected date and time from modal
    const [hours, minutes] = startTimeInput.value.split(':').map(Number);
    const scheduledDateTime = new Date(
        selectedBookingDate.getFullYear(),
        selectedBookingDate.getMonth(),
        selectedBookingDate.getDate(),
        hours,
        minutes
    );

    // Format as YYYY-MM-DD HH:MM:SS for Laravel
    const y = scheduledDateTime.getFullYear();
    const m = String(scheduledDateTime.getMonth() + 1).padStart(2, '0');
    const d = String(scheduledDateTime.getDate()).padStart(2, '0');
    const h = String(scheduledDateTime.getHours()).padStart(2, '0');
    const min = String(scheduledDateTime.getMinutes()).padStart(2, '0');
    const formattedDateTime = `${y}-${m}-${d} ${h}:${min}:00`;

    // Assign values to hidden form inputs
    document.getElementById('tutor_id').value = tutorId;
    document.getElementById('subject_id').value = subjectId;
    document.getElementById('scheduled_at').value = formattedDateTime;
    document.getElementById('duration_minutes').value = durationSelect.value; // Blade syntax
    document.getElementById('student_id').value = studentId;
    document.getElementById('status').value = 'Pending';
    document.getElementById('cost').value = ((durationSelect.value/60)*tutorRate).toFixed(2);

    if(parseFloat(document.getElementById('balance').value) < parseFloat(document.getElementById('cost').value) )
    {
        alert("Insufficient balance to book this session. Please cash in and try again.");
        return;
    }

    // Submit the hidden form
    alert("Session booked successfully.");
    document.getElementById('bookingForm').submit();
    };


        bookingModal.show();
    }

// JS to submit the hidden form when button is clicked



