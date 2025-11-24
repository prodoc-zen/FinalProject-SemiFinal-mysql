 document.addEventListener('DOMContentLoaded', () => {
            // --- MOCK PROFILE DATA (Will be replaced by Firestore) ---
            let profileData = {
                tutorName: document.getElementById('tutorName_profile').value,
                phone: document.getElementById('phone_profile').value,
                address: document.getElementById('address_profile').value,
                bio: document.getElementById('bio_profile').value,
                hourlyRate: parseFloat(document.getElementById('hourlyRate_profile').value),
                balance: parseFloat(document.getElementById('balance_profile').value),
                profilePictureUrl: document.getElementById('profilePictureUrl_profile').value,
                subjectsTeaching: JSON.parse(document.getElementById('subjectsTeaching_profile').value)
            };

            const availableSubjects = [
                'Mathematics', 'Physics', 'Chemistry','History', 'English Literature', 'Computer Science'
            ].sort();

            // --- Avatar & Image Handling Function ---
            const getInitials = (name) => {
                return name.split(' ').map(n => n[0]).join('').toUpperCase();
            };

            const setAvatar = (elementId, url, initials) => {
                const element = document.getElementById(elementId);
                if (element) {
                    if (url && url.startsWith('http')) {
                        // Display image using background property
                        element.style.backgroundImage = `url('${url}')`;
                        element.textContent = ''; // Clear initials
                        element.style.backgroundSize = 'cover';
                        element.style.backgroundPosition = 'center';
                        element.style.backgroundRepeat = 'no-repeat';
                    } else if (url && url.startsWith('data:image')) {
                        // Display temporary Data URL image (from local upload)
                        element.style.backgroundImage = `url('${url}')`;
                        element.textContent = '';
                        element.style.backgroundSize = 'cover';
                        element.style.backgroundPosition = 'center';
                        element.style.backgroundRepeat = 'no-repeat';
                    } else {
                        // Fallback to initials
                        element.style.backgroundImage = 'none';
                        element.textContent = initials;
                    }
                }
            };
            
            // Renders the list of subjects the tutor is currently teaching
            const renderSubjects = () => {
                const container = document.getElementById('currentSubjectsContainer');
                container.innerHTML = '';
                
                profileData.subjectsTeaching.forEach(subject => {
                    const badge = document.createElement('span');
                    badge.className = 'badge-subject';
                    badge.innerHTML = `${subject} 
                        <button type="button" class="ml-2 bg-transparent border-0 p-0 text-red-500 hover:text-red-700" data-subject="${subject}">
                            <i class="fas fa-times-circle"></i>
                        </button>`;
                    container.appendChild(badge);
                });

                // Attach event listeners for removal
                container.querySelectorAll('button').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const subjectToRemove = e.currentTarget.getAttribute('data-subject');
                        removeSubject(subjectToRemove);
                    });
                });
            };

            // Populates the dropdown select with subjects not currently being taught
            const populateSubjectSelect = () => {
                const select = document.getElementById('subjectSelect');
                select.innerHTML = '';

                // Add a default placeholder option
                const defaultOption = document.createElement('option');
                defaultOption.value = "";
                defaultOption.textContent = "Select a subject to add";
                defaultOption.disabled = true;
                defaultOption.selected = true;
                select.appendChild(defaultOption);

                availableSubjects.forEach(subject => {
                    if (!profileData.subjectsTeaching.includes(subject)) {
                        const option = document.createElement('option');
                        option.value = subject;
                        option.textContent = subject;
                        select.appendChild(option);
                    }
                });
            };
            
            // Loads mock data into the form fields
            const loadProfileData = () => {
                document.getElementById('profilePhone').value = profileData.phone;
                document.getElementById('profileAddress').value = profileData.address;
                document.getElementById('profileBio').value = profileData.bio;
                document.getElementById('profileRate').value = profileData.hourlyRate.toFixed(2);
                document.getElementById('profileBalance').value = profileData.balance.toFixed(2);
                updateBioCharCount(); // Initialize bio counter
                
                // --- Avatar/Image Loading ---
                const initials = getInitials(profileData.tutorName);
                
                // Header and Sidebar avatars
                setAvatar('sidebarAvatar', profileData.profilePictureUrl, initials);
                setAvatar('mobileSidebarAvatar', profileData.profilePictureUrl, initials);
                setAvatar('headerAvatar', profileData.profilePictureUrl, initials);
                
                // Profile View large image
                const profileDisplay = document.getElementById('profileImageDisplay');
                if (profileDisplay) {
                    profileDisplay.style.borderRadius = '50%'; // Ensure large avatar is round
                    setAvatar('profileImageDisplay', profileData.profilePictureUrl, initials);
                }
            };
            
            // Handles bio character counting
            const bioInput = document.getElementById('profileBio');
            const bioCharCount = document.getElementById('bioCharCount');
            const updateBioCharCount = () => {
                if (bioInput && bioCharCount) {
                    const currentLength = bioInput.value.length;
                    bioCharCount.textContent = `${currentLength}/500 characters`;
                }
            };
            
            // Handles file input change (simulates image upload and preview)
            const handlePictureUpload = (event) => {
                const file = event.target.files[0];
                if (file) {
                    // Check file size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size exceeds 2MB limit. Please choose a smaller image.');
                        event.target.value = null; // Clear file input
                        return;
                    }
                    
                    // Create a local object URL for preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const tempUrl = e.target.result;
                        
                        // Update profile data with temporary URL for immediate visual feedback
                        profileData.profilePictureUrl = tempUrl; 
                        
                        // Re-render all avatars
                        loadProfileData(); 
                        
                        // In a real application, the file would be uploaded to storage (e.g., Firebase Storage) here,
                        // and the resulting public URL would be saved to Firestore on form submission.
                        console.log("Simulated image preview set.");
                    };
                    reader.readAsDataURL(file);
                }
            };

            // --- Subject Management Logic ---

            const addSubject = () => {
                const select = document.getElementById('subjectSelect');
                const subject = select.value;
                const message = document.getElementById('subjectMessage');

                if (subject && !profileData.subjectsTeaching.includes(subject)) {
                    profileData.subjectsTeaching.push(subject);
                    profileData.subjectsTeaching.sort(); // Keep list sorted
                    renderSubjects();
                    populateSubjectSelect(); // Refresh select to remove added subject
                    message.textContent = `Subject "${subject}" added successfully.`;
                    message.style.display = 'block';
                    setTimeout(() => message.style.display = 'none', 3000);
                    select.value = ""; // Reset select
                }
            };
            
            const removeSubject = (subject) => {
                profileData.subjectsTeaching = profileData.subjectsTeaching.filter(s => s !== subject);
                renderSubjects();
                populateSubjectSelect(); // Refresh select to add removed subject back
                console.log(`Subject removed: ${subject}`);
            };

            // --- Event Listeners and Initial Load ---

            // Profile Form Submission
            document.getElementById('profileForm').addEventListener('submit', (e) => {
                e.preventDefault();
                
                // 1. Gather data from form
                const updatedData = {
                    phone: document.getElementById('profilePhone').value,
                    address: document.getElementById('profileAddress').value,
                    bio: document.getElementById('profileBio').value,
                    hourlyRate: parseFloat(document.getElementById('profileRate').value),
                    
                };

                // 2. Simple Validation (check rate is a number)
                if (isNaN(updatedData.hourlyRate)) {
                    alert('Please enter a valid hourly rate.');
                    return;
                }
                
                // 3. Update local mock data (excluding picture, which is already updated)
                profileData.phone = updatedData.phone;
                profileData.address = updatedData.address;
                profileData.bio = updatedData.bio;
                profileData.hourlyRate = updatedData.hourlyRate;
                
                // 4. Log/Save to backend (Mocked)
                console.log('Profile Data Saved:', profileData);
                
                // In a real application, you would save this to Firestore here:
                // saveProfileToFirestore(profileData); 
                
                alert('Profile updated successfully! (Data logged to console)');
            });
            
            // Bio Character Count Listener
            if (bioInput) {
                bioInput.addEventListener('input', updateBioCharCount);
            }
            
            // Profile Picture Input Listener
            const profilePictureInput = document.getElementById('profilePictureInput');
            if (profilePictureInput) {
                profilePictureInput.addEventListener('change', handlePictureUpload);
            }

            // Add Subject Button Listener
            document.getElementById('addSubjectBtn').addEventListener('click', addSubject);

            

            document.getElementById("toggleNewPassword")
                .addEventListener("click", function () {

                const input = document.getElementById("profileNewPassword");
                const icon = this.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                } else {
                    input.type = "password";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                }
            });

            document.getElementById("toggleConfirmNewPassword")
                .addEventListener("click", function () {

                const input = document.getElementById("profileConfirmNewPassword");
                const icon = this.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                } else {
                    input.type = "password";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                }
            });


            loadProfileData();
            renderSubjects();
            populateSubjectSelect();
            
        });