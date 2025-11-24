<main class="content-area" id="mainContentArea">
    <form id="profileForm">
            <!-- 7. Profile View -->
            <div id="profileView">
                <h2 class="fw-bolder fs-3 mb-1">Tutor Profile Settings</h2>
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
                                <div id="profileImageDisplay" class="user-avatar mx-auto mb-3" style="width: 120px; height: 120px; font-size: 3rem;">
                                    SJ
                                </div>
                                <input type="file" id="profilePictureInput" class="form-control" accept="image/png, image/jpeg" aria-describedby="fileHelp">
                                <div id="fileHelp" class="form-text">JPG or PNG only. Max size 2MB.</div>
                            </div>

                            
                                <div class="mb-3">
                                    <label for="profileBalance" class="form-label fw-semibold">Current Balance (Read-Only)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" id="profileBalance" class="form-control" readonly disabled>
                                    </div>
                                    <div class="form-text">Funds available for withdrawal.</div>
                                </div>

                                <?php
                                
                                    
                                ?>
                                <!-- Name -->
                                 <div class="mb-3">
                                    <label for="profileName" class="form-label fw-semibold">Full Name</label>
                                    <input type="text" id="profileName" class="form-control"  value="<?php echo $tutor->user->name; ?>">
                                </div>
                                <!-- Email -->                
                                <div class="mb-3">
                                    <label for="profileEmail" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" id="profileEmail" class="form-control" value="<?php echo $tutor->user->email; ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="profileRate" class="form-label fw-semibold">Hourly Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="profileRate" class="form-control" min="10.00" step="0.50">
                                    </div>
                                    <div class="form-text">This rate will be displayed to students.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="profilePhone" class="form-label fw-semibold">Phone Number</label>
                                    <input type="tel" id="profilePhone" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="profileAddress" class="form-label fw-semibold">Address</label>
                                    <input type="text" id="profileAddress" class="form-control">
                                </div>

                                <div class="mb-4">
                                    <label for="profileBio" class="form-label fw-semibold">Professional Bio</label>
                                    <textarea id="profileBio" class="form-control" rows="4" maxlength="500" placeholder="Introduce yourself, your experience, and your teaching philosophy..."><?php echo $tutor->bio; ?></textarea>
                                    <div class="form-text" id="bioCharCount">0/500 characters</div>
                                </div>

                        </div>
                    </div>
                    
                    <!-- Column 2: Subject Management -->
                    <div class="col-lg-6">
                        <div class="stat-card p-5">
                            <h4 class="fw-bold mb-4 border-b pb-2">Subjects You Tutor</h4>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Currently Teaching Subjects</label>
                                <div id="currentSubjectsContainer" class="d-flex flex-wrap gap-2">
                                    <!-- Subjects badges will be rendered here by JS -->
                                </div>
                                <div class="form-text mt-2">Click the 'X' to stop tutoring a subject.</div>
                            </div>

                            <div class="mb-3">
                                <label for="subjectSelect" class="form-label fw-semibold">Add New Subject</label>
                                <div class="input-group">
                                    <select id="subjectSelect" class="form-select rounded-r-none">
                                        <!-- Options will be populated by JS -->
                                    </select>
                                    <button class="btn btn-primary rounded-l-none" type="button" id="addSubjectBtn">
                                        <i class="fas fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                            <div id="subjectMessage" class="small text-success fw-semibold mt-3" style="display:none;">Subject added!</div>
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
                                        id="profileConfirmNewPassword" 
                                        class="form-control pr-5"
                                        placeholder="Enter password"
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

                            <button type="submit" class="btn btn-primary w-full">Save Profile Changes</button>
                        </div>
                    </div>
                    
                </div>

            </div>
    </form>
</main>