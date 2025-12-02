lucide.createIcons();

function setActiveSidebar(linkId) {
    // Remove "active" styling from all sidebar items
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.classList.remove('bg-[var(--primary-color)]', 'text-white', 'font-semibold', 'shadow-md');
        item.classList.add('text-gray-600', 'font-medium');
    });

    // Add "active" styling to the clicked item
    const activeLink = document.getElementById(linkId);
    activeLink.classList.add('bg-[var(--primary-color)]', 'text-white', 'font-semibold', 'shadow-md');
    activeLink.classList.remove('text-gray-600', 'font-medium');
}

function goToDashboard() 
{

    const myCarousel = document.querySelector('#dashboardCarousel');
    const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

    carousel.to(0); // Go to first slide
    
    document.getElementById('DashboardLink').classList.add('active');
    document.getElementById('TutorManagementLink').classList.remove('active');
    document.getElementById('StudentManagementLink').classList.remove('active');
    document.getElementById('BookingsLink').classList.remove('active');
    setActiveSidebar('DashboardLink');
    
}

function goToTutorManagement() 
{
    // Switch to Carousel item #2 (index starts at 0)
    const myCarousel = document.querySelector('#dashboardCarousel');
    const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

    carousel.to(1); // Go to second slide
    

    document.getElementById('DashboardLink').classList.remove('active');
    document.getElementById('TutorManagementLink').classList.add('active');
    document.getElementById('StudentManagementLink').classList.remove('active');
    
    document.getElementById('BookingsLink').classList.remove('active');
    setActiveSidebar('TutorManagementLink');
}

function goToStudentManagement() 
{

    
    // Switch to Carousel item #2 (index starts at 0)
    const myCarousel = document.querySelector('#dashboardCarousel');
    const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

    carousel.to(2); // Go to third slide
    document.getElementById('DashboardLink').classList.remove('active');
    document.getElementById('TutorManagementLink').classList.remove('active');
    document.getElementById('StudentManagementLink').classList.add('active');
    document.getElementById('BookingsLink').classList.remove('active');
    setActiveSidebar('StudentManagementLink');
}

function goToBookings() 
{
    // Switch to Carousel item #2 (index starts at 0)
    const myCarousel = document.querySelector('#dashboardCarousel');
    const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

    carousel.to(3); // Go to fourth slide
    
    document.getElementById('DashboardLink').classList.remove('active');
    document.getElementById('TutorManagementLink').classList.remove('active');
    document.getElementById('StudentManagementLink').classList.remove('active');
    document.getElementById('BookingsLink').classList.add('active');
    setActiveSidebar('BookingsLink');
}


//suspension modal methods
let currentTutorToSuspend = '';

function openSuspendModal(data, role, id) 
{
    document.getElementById('itemToDelete').textContent = data;
    suspendModal.classList.remove('hidden');

    if(role == "tutor") {
        document.getElementById('tutorIdToDelete').value = id;
        document.getElementById('role_delete').value = role;
        
    }
    else if(role == "student") {
        document.getElementById('studentIdToDelete').value = id;
        document.getElementById('role_delete').value = role;
        
    }
    else if(role == "user") {
       document.getElementById('userIdToDelete').value = id;
       document.getElementById('role_delete').value = role;
       
    }
    else if(role == "booking") {
        document.getElementById('bookingIdToDelete').value = id;
        document.getElementById('role_delete').value = role;
    }
}   

function closeSuspendModal() {
    document.getElementById('itemToDelete').textContent = '';
    suspendModal.classList.add('hidden');
}

function submitDeleteForm() {
    if(document.getElementById('role_delete').value == "tutor") 
    {
        document.getElementById('deleteTutor').submit();
    }
    else if(document.getElementById('role_delete').value == "student")
    {
        document.getElementById('deleteStudent').submit();
    }
    else if(document.getElementById('role_delete').value == "user")
    {
        document.getElementById('deleteUser').submit();
    }
    else if(document.getElementById('role_delete').value == "booking")
    {
        document.getElementById('deleteBooking').submit();
    }
}


//edit modal for tutor
function openTutorEditModal(id, email, balance, name) 
{
    
    document.getElementById('editId_tutor').value = id;
    document.getElementById('editEmail_tutor').value = email;
    document.getElementById('editBalance_tutor').value = balance;
    document.getElementById('editName_tutor').value = name;
    document.getElementById('tutorid_edit_header').textContent = id;
    
    editTutorModal.classList.remove('hidden');
    // Re-create Lucide icons inside the dynamically inserted modal content
    lucide.createIcons(); 
}

function closeEditModal() {
    editTutorModal.classList.add('hidden');
// Clear data on close
}




function saveTutorDetails()
{
    document.getElementById('editTutorForm').submit();
}




//student edit modal

function openStudentEditModal(id, email, balance, name) 
{
    
    document.getElementById('editId_student').value = id;
    document.getElementById('editEmail_student').value = email;
    document.getElementById('editBalance_student').value = balance;
    document.getElementById('editName_student').value = name;
    document.getElementById('studentid_edit_header').textContent = id;
    
    editStudentModal.classList.remove('hidden');
    // Re-create Lucide icons inside the dynamically inserted modal content
    lucide.createIcons(); 
}

function closeStudentEditModal() {
    editStudentModal.classList.add('hidden');
 // Clear data on close
}


function saveStudentDetails()
{
    document.getElementById('editStudentForm').submit();
}




//booking edit modal

function openBookingEditModal(id, status) 
{
    
    document.getElementById('editId_booking').value = id;
    document.getElementById('editStatus_booking').value = status;
    document.getElementById('bookingid_edit_header').textContent = id;
    
    editBookingModal.classList.remove('hidden');
    // Re-create Lucide icons inside the dynamically inserted modal content
    lucide.createIcons(); 
}

function closeBookingEditModal() {
    editBookingModal.classList.add('hidden');
 // Clear data on close
}


function saveBookingDetails()
{   
    // alert("booking id: " + document.getElementById('editId_booking').value + " status: " + document.getElementById('editStatus_booking').value);
    document.getElementById('editStatus2_booking').value =  document.getElementById('editStatus_booking').value;
    document.getElementById('editBookingForm').submit();
}


//add account modal

function openAddAccountModal($role) 
{

    document.getElementById('role_addAccount').value = $role;
    if($role == "tutor") {
        document.getElementById('addAccountModalTitle').textContent = "Add New Tutor Account";
    }
    else if($role == "student") {
        document.getElementById('addAccountModalTitle').textContent = "Add New Student Account";
    }
    
    addAccountModal.classList.remove('hidden');
    // Re-create Lucide icons inside the dynamically inserted modal content
    lucide.createIcons(); 
}

function closeAddAccountModal() {
    addAccountModal.classList.add('hidden');
 // Clear data on close
}


