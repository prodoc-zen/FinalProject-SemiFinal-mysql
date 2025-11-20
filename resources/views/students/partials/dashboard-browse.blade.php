<main class="content-area" id="mainContentArea">

             <!-- BROWSE TUTORS CONTENT START -->
            <div class="container-fluid px-0">
                <h1 class="h2 fw-bold mb-4 text-dark">Browse Tutors</h1>

                <!-- Search and Filter Bar -->
                <div class="row mb-5 gx-3">
                    <!-- Search Input -->
                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" id="tutorSearchInput" oninput="filterTutors()"
                                   class="form-control border-start-0 py-2 rounded-end-3"
                                   placeholder="Search by name or subject..." aria-label="Search tutors">
                        </div>
                    </div>
                    <!-- Filter Dropdown -->
                    <div class="col-12 col-md-4 col-lg-3 mt-3 mt-md-0">
                        <select class="form-select py-2" aria-label="Default select example">
                            <option selected>All Subjects</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="English Literature">English Literature</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="History">History</option>
                        </select>
                    </div>
                </div>

                <!-- Tutor Cards Grid -->
                <div id="tutorGrid" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                    <!-- Tutor Card 1: Dr. Sarah Johnson (Math) -->
                    <div class="col tutor-container">
                        <div class="tutor-card card p-4 shadow-sm">
                            <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">
                                <div class="icon-box flex-shrink-0"><i class="fas fa-calculator"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark tutor-name">Dr. Sarah Johnson</h5>
                                    <p class="text-sm fw-semibold mb-1 tutor-subject" style="color:var(--tm-dark-green);">Mathematics</p>
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-flex align-items-center me-3"><i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i> 4.8 (127 reviews)</span>
                                    </div>
                                    <p class="text-muted mt-2 small">PhD in Mathematics with engaging teaching style. Specializing in advanced algebra and calculus prep.</p>
                                    <p class="text-muted small">10+ years experience</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                <h6 class="fw-bold text-xl text-dark mb-0">$45<span class="small fw-normal text-muted">/hour</span></h6>
                                <button class="btn book-button text-white shadow-sm">Book Session</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tutor Card 2: Prof. Michael Chen (Physics) -->
                    <div class="col tutor-container">
                        <div class="tutor-card card p-4 shadow-sm">
                            <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">
                                <div class="icon-box flex-shrink-0"><i class="fas fa-atom"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark tutor-name">Prof. Michael Chen</h5>
                                    <p class="text-sm fw-semibold mb-1 tutor-subject" style="color:var(--tm-dark-green);">Physics</p>
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-flex align-items-center me-3"><i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i> 4.8 (98 reviews)</span>
                                    </div>
                                    <p class="text-muted mt-2 small">Former university professor specializing in quantum physics. Excellent at simplifying complex mechanics.</p>
                                    <p class="text-muted small">8 years experience</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                <h6 class="fw-bold text-xl text-dark mb-0">$50<span class="small fw-normal text-muted">/hour</span></h6>
                                <button class="btn book-button text-white shadow-sm">Book Session</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tutor Card 3: Emma Williams (English) -->
                    <div class="col tutor-container">
                        <div class="tutor-card card p-4 shadow-sm">
                            <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">
                                <div class="icon-box flex-shrink-0"><i class="fas fa-book-open"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark tutor-name">Emma Williams</h5>
                                    <p class="text-sm fw-semibold mb-1 tutor-subject" style="color:var(--tm-dark-green);">English Literature</p>
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-flex align-items-center me-3"><i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i> 5 (156 reviews)</span>
                                    </div>
                                    <p class="text-muted mt-2 small">Published author and literature enthusiast. Specializing in essay structuring, literary analysis, and AP prep.</p>
                                    <p class="text-muted small">7 years experience</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                <h6 class="fw-bold text-xl text-dark mb-0">$40<span class="small fw-normal text-muted">/hour</span></h6>
                                <button class="btn book-button text-white shadow-sm">Book Session</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tutor Card 4: David Martinez (Computer Science) -->
                    <div class="col tutor-container">
                        <div class="tutor-card card p-4 shadow-sm">
                            <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">
                                <div class="icon-box flex-shrink-0"><i class="fas fa-code"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark tutor-name">David Martinez</h5>
                                    <p class="text-sm fw-semibold mb-1 tutor-subject" style="color:var(--tm-dark-green);">Computer Science</p>
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-flex align-items-center me-3"><i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i> 4.7 (89 reviews)</span>
                                    </div>
                                    <p class="text-muted mt-2 small">Software engineer with a passion for teaching programming (Python, Java, C++). Specializes in data structures and algorithms.</p>
                                    <p class="text-muted small">5 years experience</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                <h6 class="fw-bold text-xl text-dark mb-0">$55<span class="small fw-normal text-muted">/hour</span></h6>
                                <button class="btn book-button text-white shadow-sm">Book Session</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tutor Card 5: Dr. Lisa Anderson (Chemistry) -->
                    <div class="col tutor-container">
                        <div class="tutor-card card p-4 shadow-sm">
                            <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">
                                <div class="icon-box flex-shrink-0"><i class="fas fa-flask"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark tutor-name">Dr. Lisa Anderson</h5>
                                    <p class="text-sm fw-semibold mb-1 tutor-subject" style="color:var(--tm-dark-green);">Chemistry</p>
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-flex align-items-center me-3"><i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i> 4.9 (112 reviews)</span>
                                    </div>
                                    <p class="text-muted mt-2 small">Biochemistry PhD with engaging teaching style. Focusing on organic and inorganic chemistry for high school and college students.</p>
                                    <p class="text-muted small">12 years experience</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                <h6 class="fw-bold text-xl text-dark mb-0">$48<span class="small fw-normal text-muted">/hour</span></h6>
                                <button class="btn book-button text-white shadow-sm">Book Session</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tutor Card 6: James Wilson (History) -->
                    <div class="col tutor-container">
                        <div class="tutor-card card p-4 shadow-sm">
                            <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">
                                <div class="icon-box flex-shrink-0"><i class="fas fa-scroll"></i></div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-dark tutor-name">James Wilson</h5>
                                    <p class="text-sm fw-semibold mb-1 tutor-subject" style="color:var(--tm-dark-green);">History</p>
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-flex align-items-center me-3"><i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i> 4.6 (74 reviews)</span>
                                    </div>
                                    <p class="text-muted mt-2 small">History buff specializing in World War and Ancient civilizations. Great for research paper guidance and test prep.</p>
                                    <p class="text-muted small">6 years experience</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                <h6 class="fw-bold text-xl text-dark mb-0">$38<span class="small fw-normal text-muted">/hour</span></h6>
                                <button class="btn book-button text-white shadow-sm">Book Session</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


</main>