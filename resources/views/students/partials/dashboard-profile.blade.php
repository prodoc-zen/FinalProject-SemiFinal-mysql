<main class="content-area" id="mainContentArea">
    <form id="profileForm" method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
         @csrf
            <!-- 7. Profile View -->
            <div id="profileView">
                <h2 class="fw-bolder fs-3 mb-1">Student Profile Settings</h2>
                <p class="text-muted mb-4">Update your contact details, financial settings, and subjects you tutor.</p>

                    <div class="row g-4">
                    <!-- Column 1: Personal & Financial Settings -->
                    <div class="col-lg-6">
                        <div class="stat-card p-5">
                            <h4 class="fw-bold mb-4 border-b pb-2">Profile & Contact Details</h4>
                            
                            <!-- Profile Picture Section -->
                            <div class="mb-4 text-center">
                                <label class="form-label fw-semibold mb-3 d-block">Profile Picture</label>
                                <!-- Avatar Display: will be styled via JS to show image or initials -->
                                <div id="profileImageDisplay" class="mx-auto mb-3" style="width:120px; height:120px;">
                                    <img 
                                        src="{{ $student->profile_picture }}" 
                                        alt="Profile Picture" 
                                        class="rounded-circle"
                                        style="width:100%; height:100%; object-fit:cover;"
                                    >
                                </div>
                                <input type="file" name="profilePictureInput" id="profilePictureInput" class="form-control" accept="image/png, image/jpeg" aria-describedby="fileHelp">
                                <div id="fileHelp" class="form-text">JPG or PNG only. Max size 2MB.</div>
                            </div>

                            
                                <div class="mb-3">
                                    <label for="profileBalance" class="form-label fw-semibold">Current Balance (Read-Only)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" name="profileBalance" id="profileBalance" class="form-control" value="{{ number_format($student->balance, 2) }}" readonly disabled>
                                    </div>
                                    <div class="form-text">Funds available for withdrawal.</div>
                                </div>

                                <?php
                                
                                    
                                ?>
                                <!-- Name -->
                                 <div class="mb-3">
                                    <label for="profileName" class="form-label fw-semibold">Full Name</label>
                                    <input type="text" name="profileName" id="profileName" class="form-control"  value="{{ $student->user->name }}">
                                </div>
                                <!-- Email -->                
                                <div class="mb-3">
                                    <label for="profileEmail" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" name="profileEmail" id="profileEmail" class="form-control" value="{{ $student->user->email }}" readonly disabled>
                                </div>
                                

                                <div class="mb-3">
                                    <label for="profilePhone" class="form-label fw-semibold">Phone Number</label>
                                    <input type="tel" name="profilePhone" id="profilePhone" class="form-control" value="{{ $student->phone }}">
                                </div>

                                <div class="mb-3">
                                    <label for="profileAddress" class="form-label fw-semibold">Address</label>
                                    <input type="text" name="profileAddress" id="profileAddress" class="form-control" value="{{ $student->address }}">
                                </div>

                                <div class="mb-4">
                                    <label for="profileBio" class="form-label fw-semibold">Professional Bio</label>
                                    <textarea name="profileBio" id="profileBio" class="form-control" rows="4" maxlength="500" placeholder="Introduce yourself, your experience, and your teaching philosophy...">{{ $student->bio }}</textarea>
                                    <div class="form-text" id="bioCharCount">0/500 characters</div>
                                </div>

                        </div>
                    </div>
                    
                  
                    <!--Change Password -->
                    <div class="col-lg-6">
                        <div class="stat-card p-5">
                            <h4 class="fw-bold mb-4 border-b pb-2 text-danger"><i class="fas fa-lock mr-2"></i>         Account Security</h4>
                            

                            <!-- New Password -->
                             <div class="mb-3">
                                <label for="profileNewPassword" class="form-label fw-semibold">New Password</label>
                                <div class="position-relative">
                                    <input 
                                        type="password" 
                                        id="profileNewPassword" 
                                        class="form-control pr-5"
                                        placeholder="Enter password"
                                        name="profileNewPassword"
                                    >

                                    <span 
                                        id="toggleNewPassword"
                                        class="position-absolute top-50 end-0 translate-middle-y me-3"
                                        style="cursor: pointer;"
                                    >
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>


                            <!-- Confirm New Password -->
                            <div class="mb-3">
                                <label for="profileConfirmNewPassword" class="form-label fw-semibold">Confirm New Password</label>
                                <div class="position-relative">
                                    <input 
                                        type="password" 
                                        id="profileNewPassword_confirmation" 
                                        class="form-control pr-5"
                                        placeholder="Enter password"
                                        name="profileNewPassword_confirmation"
                                    >
                                        
                                    <span 
                                        id="toggleConfirmNewPassword"
                                        class="position-absolute top-50 end-0 translate-middle-y me-3"
                                        style="cursor: pointer;"
                                    >
                                        <i class="fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>

                            <div id="passwordError" class="text-danger mb-3" style="display:none;">
                                Passwords do not match
                            </div>
                           
                            </form>
                            <button type="button" class="btn btn-primary w-full" id="saveProfileBtn">Save Profile Changes</button>
                            
                        </div>
                    </div>
                    
                </div>

            </div>
            
   
</main>