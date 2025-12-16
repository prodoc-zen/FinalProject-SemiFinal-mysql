<div id="suspendModal" class="modal-overlay fixed inset-0 z-40 hidden flex items-center justify-center p-4" aria-modal="true" role="dialog">
        <!-- Modal Content -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-auto transform transition-all overflow-hidden">
            <div class="p-6">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-[var(--dark-text)]">Confirm Delete</h3>
                    </div>
                </div>
                <div class="mt-4 text-gray-600">
                    <p class="mt-2 font-medium text-sm" id="tutorNameDisplay">Are you sure you want to proceed and delete <span id="itemToDelete" class="text-red-500 "></span></p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button onclick="closeSuspendModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button onclick="submitDeleteForm()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition shadow-md">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>



    <!-- Edit Tutor -->
    <div id="editTutorModal" class="modal-overlay fixed inset-0 z-40 hidden flex items-center justify-center p-4" aria-modal="true" role="dialog">
        <!-- Modal Content -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto transform transition-all overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-[var(--dark-text)]">Edit Tutor Details ID # <span id="tutorid_edit_header"></span></h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-700">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <!-- Form Body -->
            
            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-600">Update the core details for this tutor account.</p>
                    <form id="editTutorForm" action="{{ route('admin.tutor.edit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="editId_tutor" id="editId_tutor">

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="editName_tutor" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="editName_tutor" id="editName_tutor" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border">
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="editEmail_tutor" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="editEmail_tutor" id="editEmail_tutor" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border">
                        <x-input-error :messages="$errors->get('editEmail_tutor')" />
                    </div>
                
               
                
                <!-- Status & Rating Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        
                        <!-- Balance -->
                        <div>
                            <label for="editBalance_tutor" class="block text-sm font-medium text-gray-700">Current Balance</label>
                            <input type="number" name="editBalance_tutor" id="editBalance_tutor" step="0.1" min="0" max="5" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border">
                            <x-input-error :messages="$errors->get('editBalance_tutor')" />
                        </div>
                    </div>
                </form>

            </div>
            
           
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button onclick="saveTutorDetails()" class="px-4 py-2 text-sm font-medium text-white bg-[var(--primary-color)] rounded-lg hover:bg-teal-700 transition shadow-md">
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Student -->
    <div id="editStudentModal" class="modal-overlay fixed inset-0 z-40 hidden flex items-center justify-center p-4" aria-modal="true" role="dialog">
        <!-- Modal Content -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto transform transition-all overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-[var(--dark-text)]">Edit Student Details ID # <span id="studentid_edit_header"></span></h3>
                <button onclick="closeStudentEditModal()" class="text-gray-400 hover:text-gray-700">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <!-- Form Body -->
            
            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-600">Update the core details for this student account.</p>
                    <form id="editStudentForm" action="{{ route('admin.student.edit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="editId_student" id="editId_student">

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="editName_student" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="editName_student" id="editName_student" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border">
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="editEmail_student" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="editEmail_student" id="editEmail_student" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border">
                        <x-input-error :messages="$errors->get('editEmail_student')" />
                    </div>
                
               
                
                <!-- Status & Rating Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        
                        <!-- Balance -->
                        <div>
                            <label for="editBalance_student" class="block text-sm font-medium text-gray-700">Current Balance</label>
                            <input type="number" name="editBalance_student" id="editBalance_student" step="0.1" min="0" max="5" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border">
                            <x-input-error :messages="$errors->get('editBalance_student')" />
                        </div>
                    </div>
                </form>

            </div>
            
           
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button onclick="closeStudentEditModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button onclick="saveStudentDetails()" class="px-4 py-2 text-sm font-medium text-white bg-[var(--primary-color)] rounded-lg hover:bg-teal-700 transition shadow-md">
                    Save Changes
                </button>
            </div>
        </div>
    </div>


    <!-- Edit Booking -->
    <div id="editBookingModal" class="modal-overlay fixed inset-0 z-40 hidden flex items-center justify-center p-4" aria-modal="true" role="dialog">
        <!-- Modal Content -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto transform transition-all overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-[var(--dark-text)]">Edit Booking Details ID # <span id="bookingid_edit_header"></span></h3>
                <button onclick="closeBookingEditModal()" class="text-gray-400 hover:text-gray-700">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <!-- Form Body -->
            
            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-600">Update the core details for this booking details.</p>
                    <form id="editBookingForm" action="{{ route('admin.booking.edit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="editId_booking" id="editId_booking">
                    <input type="hidden" id="editStatus2_booking" name ="editStatus2_booking">
                   
                <!-- Status & Rating Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        
                        <div>
                            <label for="editStatus_booking" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="editStatus_booking" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border bg-white">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                                
                            </select>
                    </div>
                    </div>
                </form>

            </div>
            
           
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button onclick="closeBookingEditModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button onclick="saveBookingDetails()" class="px-4 py-2 text-sm font-medium text-white bg-[var(--primary-color)] rounded-lg hover:bg-teal-700 transition shadow-md">
                    Save Changes
                </button>
            </div>
        </div>
    </div>



    <!-- Add Account -->
    <div id="addAccountModal" class="modal-overlay fixed inset-0 z-40 hidden flex items-center justify-center p-4" aria-modal="true" role="dialog">
        <!-- Modal Content -->
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto transform transition-all overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-[var(--dark-text)]" id="addAccountModalTitle">Add a new Account</h3>
                <button onclick="closeAddAccountModal()" class="text-gray-400 hover:text-gray-700">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <!-- Form Body -->
            
            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-600">Fill up the ff. details to create an account.</p>
                    <form id="addAccountForm" action="{{ route('admin.account.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_addAccount" id="role_addAccount">

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="addName_addAccount" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="addName_addAccount" id="addName_addAccount" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="addEmail_addAccount" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="addEmail_addAccount" id="addEmail_addAccount" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border" required>
                        <x-input-error :messages="$errors->get('addEmail_addAccount')" />
                    </div>

                    <!-- Password Field -->
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="addPassword_addAccount" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="addPassword_addAccount" id="addPassword_addAccount"  
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border" 
                            required>
                        <x-input-error :messages="$errors->get('addPassword_addAccount')" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="addPassword_addAccount_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="addPassword_addAccount_confirmation" id="addPassword_addAccount_confirmation" 
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[var(--primary-color)] focus:ring-[var(--primary-color)] p-3 border" 
                            required
                            oninput="
                                if (this.value !== document.getElementById('addPassword_addAccount').value) {
                                    this.setCustomValidity('Passwords do not match.');
                                } else if (this.value.length < 8) {
                                    this.setCustomValidity('Password must be at least 8 characters long.');
                                }
                                else{
                                    this.setCustomValidity('');
                                }
                            ">
                    </div>

                

            </div>
            
           
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button onclick="closeAddAccountModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit" onclick="saveAddAccount()" class="px-4 py-2 text-sm font-medium text-white bg-[var(--primary-color)] rounded-lg hover:bg-teal-700 transition shadow-md">
                    Save Changes
                </button>
            </div>
            </form>
        </div>
    </div>