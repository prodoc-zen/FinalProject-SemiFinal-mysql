<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuturo Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons for Web Pages -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Theme Colors matching the previous chat UI */
            --primary-color: #5c9232;
            --primary-light: #CCFBF1; 
            --secondary-bg: #F0FDF4; /
            --dark-text: #1F2937; 
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6; /* Light gray background */
        }
        
        .sidebar-item:hover {
            background-color: rgba(13, 148, 136, 0.1);
        }

        /* Custom Scrollbar */
        .dashboard-content::-webkit-scrollbar {
            width: 8px;
        }
        .dashboard-content::-webkit-scrollbar-thumb {
            background: #D1D5DB; /* Gray 300 */
            border-radius: 4px;
        }
        .dashboard-content::-webkit-scrollbar-track {
            background: #F3F4F6;
        }

        .my-carousel {
            position: relative;
            width: 100%;
        }

        .carousel-item {
            display: none;
            width: 100%;
            transition: none !important;
        }

        .carousel-item.active {
            display: block;
        }

        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(2px);
        }
    </style>
</head>
<body class="flex min-h-screen">



    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out bg-white w-64 z-30 shadow-xl flex flex-col">
        <!-- Logo/Title -->
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center">
                <i data-lucide="graduation-cap" class="w-8 h-8 text-[var(--primary-color)] mr-2"></i>
                <h1 class="text-xl font-extrabold text-[var(--dark-text)]">Tuturo</h1>
            </div>
            <!-- Close button for mobile -->
            <button id="closeSidebar" class="lg:hidden p-1 text-gray-500 hover:text-[var(--dark-text)] rounded-full hover:bg-gray-100">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 p-4 space-y-2">
            <!-- Active Link -->
            <a id="DashboardLink" onclick="goToDashboard()" class="sidebar-item flex items-center p-3 rounded-xl font-semibold text-white bg-[var(--primary-color)] transition duration-150 shadow-md active-link  cursor-pointer" data-content="main-dashboard">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            <a id="TutorManagementLink" onclick="goToTutorManagement()" class="sidebar-item flex items-center p-3 rounded-xl font-medium text-gray-600 hover:text-[var(--primary-color)] transition duration-150  cursor-pointer" data-content="tutor-management">
                <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                Tutor Management
            </a>
            <a id="StudentManagementLink" onclick="goToStudentManagement()" class="sidebar-item flex items-center p-3 rounded-xl font-medium text-gray-600 hover:text-[var(--primary-color)] transition duration-150  cursor-pointer" data-content="student-management">
                <i data-lucide="user-check" class="w-5 h-5 mr-3"></i>
                Student Management
            </a>
            <a id="BookingsLink" onclick="goToBookings()" class="sidebar-item flex items-center p-3 rounded-xl font-medium text-gray-600 hover:text-[var(--primary-color)] transition duration-150  cursor-pointer" data-content="bookings">
                <i data-lucide="calendar-check" class="w-5 h-5 mr-3"></i>
                Bookings
            </a>
        </nav>
        
        <!-- Admin Profile Mockup -->
        <div class="p-4 border-t border-gray-100 mt-auto">
            <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                <img 
                    src="https://placehold.co/40x40/34D399/FFFFFF?text=A" 
                    alt="Admin" 
                    class="w-10 h-10 rounded-full object-cover mr-3"
                >
                <div>
                    <div class="font-semibold text-sm text-[var(--dark-text)]">Admin Master</div>
                    <div class="text-xs text-gray-500">System Manager</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-2 w-full text-center text-sm text-red-500 hover:text-red-700 transition">
                    <i data-lucide="log-out" class="w-4 h-4 inline-block mr-1"></i> Logout
                </button>
            </form>
            
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 lg:ml-64 flex flex-col">
        <!-- Header/Top Nav -->
        <header class="sticky top-0 bg-white shadow-sm p-4 flex justify-between items-center z-20">
            <!-- Menu Button for Mobile -->
            <button id="openSidebar" class="lg:hidden p-2 text-gray-600 hover:text-[var(--primary-color)] rounded-full hover:bg-gray-100 mr-4">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <h2 id="pageTitle" class="text-2xl font-bold text-[var(--dark-text)]">Dashboard</h2>
            
            <div class="flex items-center space-x-4">
                
                <div class="text-sm font-medium text-gray-600 hidden sm:block">Welcome back, Admin!</div>
            </div>
        </header>

        <!-- Dynamic Dashboard Content -->
        <main class="dashboard-content flex-1 p-6 space-y-6 overflow-y-auto">

            <div id="dashboardCarousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">

                    <div class="carousel-item active" id="slideDashboard">
                        @include('admin.partials.dashboard-main')
                    </div>

                    <div class="carousel-item" id="slideTutor">
                        @include('admin.partials.dashboard-tutorManagement')
                    </div>

                    <div class="carousel-item" id="slideStudent">
                        @include('admin.partials.dashboard-studentManagement')
                    </div>

                    <div class="carousel-item" id="slideBookings">
                        @include('admin.partials.dashboard-bookings')
                    </div>

                </div>
            </div>
        </main>
    </div>
    
    @include('admin.partials.dashboard-modals')
    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden transition-opacity duration-300"></div>
    <input type="hidden" id="role_delete">



    <script src={{ asset('js/dashboard-admin.js') }} ></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src={{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }} ></script>

</body>
</html>