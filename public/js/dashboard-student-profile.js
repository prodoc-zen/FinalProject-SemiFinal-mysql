 document.addEventListener('DOMContentLoaded', () => {
            // --- MOCK PROFILE DATA (Will be replaced by Firestore) ---
            let profileData = {
                studentName: document.getElementById('studentName_profile').value,
                phone: document.getElementById('phone_profile').value,
                address: document.getElementById('address_profile').value,
                bio: document.getElementById('bio_profile').value,
                balance: parseFloat(document.getElementById('balance_profile').value),
                profilePictureUrl: document.getElementById('profilePictureUrl_profile').value,
            };

    

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
            
            // Loads mock data into the form fields
            const loadProfileData = () => {
                document.getElementById('profilePhone').value = profileData.phone;
                document.getElementById('profileAddress').value = profileData.address;
                document.getElementById('profileBio').value = profileData.bio;
                document.getElementById('profileBalance').value = profileData.balance.toFixed(2);
                updateBioCharCount(); // Initialize bio counter
                
                // --- Avatar/Image Loading ---
                const initials = getInitials(profileData.studentName);
                
                // Header and Sidebar avatars
                
                // Profile View large image
                const profileInput = document.getElementById('profilePictureInput');
                const profileDisplay = document.getElementById('profileImageDisplay');

                if (profileInput && profileDisplay) {
                    profileInput.addEventListener('change', function() {
                        const file = this.files[0];
                        if (!file) return; // user canceled

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const dataUrl = e.target.result;
                            setAvatar('profileImageDisplay', dataUrl, initials);
                        };
                        reader.readAsDataURL(file);
                    });
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
                        profileData.profilePictureUrl = file.name; 
                        
                        // In a real application, the file would be uploaded to storage (e.g., Firebase Storage) here,
                        // and the resulting public URL would be saved to Firestore on form submission.
                        console.log("Simulated image preview set.");
                    };
                    reader.readAsDataURL(file);
                }
            };


            
 

            // --- Event Listeners and Initial Load ---

            // Profile Form Submission

            
            document.getElementById('saveProfileBtn').addEventListener('click', (e) => {
                const newPassword = document.getElementById('profileNewPassword').value;
                const confirmNewPassword = document.getElementById('profileNewPassword_confirmation').value;
                const phone = document.getElementById('profilePhone').value;
                const address = document.getElementById('profileAddress').value;
                const bio = document.getElementById('profileBio').value;
                const name = document.getElementById('profileName').value;

                if(phone.trim() === "" || address.trim() === "" || bio.trim() === "" || name.trim() === "")
                {
                    alert("Please fill in all required fields.");
                    return;
                }

                if((newPassword.length > 0 && newPassword.length < 8) && (confirmNewPassword.length > 0 && confirmNewPassword.length < 8))
                {
                    alert("Password must be at least 1-8 characters long, but leave blank if you do not wish to change it.");
                    return;
                }
                if(newPassword === confirmNewPassword)
                {
                    document.getElementById("passwordError").style.display = "none";
                    const confirmed = confirm("Are you sure you want to save these changes?");
                    if (!confirmed) {
                        return;
                    }
                    
                    document.getElementById('profileForm').submit();
                }
                else
                {
                    document.getElementById("passwordError").style.display = "block";
                    return;
                } 
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

                const input = document.getElementById("profileNewPassword_confirmation");
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
            
        });