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
                        <select id="subjectFilter" class="form-select py-2" onchange="filterTutors()">
                            <option value="">All Subjects</option>
                            <option value="computer science">Computer Science</option>
                            <option value="mathematics">Mathematics</option>
                            <option value="physics">Physics</option>
                            <option value="english literature">English Literature</option>
                            <option value="chemistry">Chemistry</option>
                            <option value="history">History</option>
                        </select>
                    </div>
                </div>

                <!-- Tutor Cards Grid -->
                <div id="tutorGrid" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                    @forelse ($tutors as $ts)
                        <div class="col tutor-container">
                            <div class="tutor-card card p-4 shadow-sm">

                                <div class="d-flex align-items-start gap-3 mb-3 flex-grow-1">

                                    <!-- Profile Picture -->
                                    <div class="rounded-circle overflow-hidden flex-shrink-0"
                                        style="width:64px;height:64px;border:2px solid #e6e6e6;">
                                        <img src="{{ $ts->tutor->profile_picture}}"
                                            alt="Tutor Photo"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    </div>

                                    <div class="flex-grow-1">

                                        <!-- Name + Subject -->
                                        <h5 class="fw-bold mb-1 text-dark tutor-name">
                                            {{ $ts->tutor?->user?->name ?? 'Unknown Tutor' }}
                                        </h5>

                                        <p class="text-sm fw-semibold mb-1 tutor-subject"
                                        style="color:var(--tm-dark-green);">
                                            {{ $ts->subject?->name ?? 'No Subject' }}
                                        </p>

                                        <!-- Rating -->
                                        <div class="text-xs text-muted mb-2">
                                            <span class="d-inline-flex align-items-center me-3">
                                                <i class="fas fa-star text-warning me-1" style="font-size: 0.75rem;"></i>
                                                {{ rand(1,5) }}
                                                ({{ rand(40,150) }} reviews)
                                            </span>
                                        </div>

                                        <!-- Bio -->
                                        <p class="text-muted small mb-1">
                                            {{ $ts->tutor?->bio ?? 'No description available.' }}
                                        </p>

                                        <!-- Experience -->
                                        <p class="text-muted small">
                                            {{ rand(3,12) }} years experience
                                        </p>
                                    </div>
                                </div>

                                

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light-subtle">
                                    <h6 class="fw-bold text-xl text-dark mb-0">
                                        ${{ $ts->tutor?->hourly_rate ?? 0.69 }}
                                        <span class="small fw-normal text-muted">/hour</span>
                                    </h6>

                                    <button 
                                        class="btn btn-primary text-white shadow-sm"
                                        onclick="openBookingModal(this)"
                                        data-tutor-name="{{ $ts->tutor?->user?->name ?? 'Unknown Tutor' }}"
                                        data-tutor-subject="{{ $ts->subject?->name ?? 'No Subject' }}"
                                        data-tutor-rate="{{ $ts->tutor?->hourly_rate ?? 15 }}"
                                        data-tutor-id="{{ $ts->tutor?->id ?? 0 }}"
                                        data-subject-id="{{ $ts->subject->id ?? 0 }}"
                                        data-student-id="{{ $student->id ?? 0 }}">
                                        Book Session
                                    </button>
                                </div>

                            </div>
                        </div>
                    @empty
                        
                        <p class="text-muted small mb-3">No tutors have been registered yet.</p>
                            
                    @endforelse
                    <p class="text-muted small mb-3" id="noTutorsMessage" style="display:none;">No tutors have been found.</p>


                </div>
            </div>


</main>

