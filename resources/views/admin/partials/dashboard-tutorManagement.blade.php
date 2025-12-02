<div id="tutor-management" class="content-view">
                <h3 class="text-3xl font-bold text-[var(--dark-text)] mb-6">Tutor Management</h3>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-gray-600">List of all Tutors on the platform.</p>
                        <button onclick="openAddAccountModal('tutor')" class="flex items-center bg-[var(--primary-color)] text-white text-sm font-semibold py-2 px-4 rounded-full hover:bg-teal-700 transition">
                            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add New Tutor
                        </button>
                    </div>
                    
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject Expertise</th>        
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Hours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wallet Balance</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tutors as $tutor)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">
                                        #{{ $tutor->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">{{ $tutor->user->name }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" id="rating">{{$tutor->user->email}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @php
                                            $count = 0;
                                            $subjects = $tutors_subjects->where('tutor_id', $tutor->id)->values();
                                            $lastIndex = count($subjects) - 1;

                                            foreach($subjects as $index => $subject) {
                                                echo $subject->subject->name;

                                                if ($index !== $lastIndex) {
                                                    echo ", ";
                                                }
                                                $count++;
                                            }
                                            if($count == 0)
                                                echo "None";
                                        @endphp
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @php
                                        $totalHours = 0;
                                        foreach($bookings as $booking) {
                                            if($booking->tutor->id == $tutor->id && $booking->status == 'completed') {
                                                $totalHours += $booking->duration_minutes; // assuming 'duration' is in hours
                                            }
                                        }
                                        echo $totalHours/60 . " hrs";
                                    @endphp
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">{{$tutor->balance}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4 flex items-center">
                                        <!-- Edit -->
                                        <a onclick="openTutorEditModal({{ $tutor->id }}, '{{ $tutor->user->email }}', '{{ $tutor->balance }}', '{{ $tutor->user->name }}')" class="text-[var(--primary-color)] hover:text-teal-800 cursor-pointer">
                                            <i data-lucide="pencil" class="w-5 h-5"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a onclick="openSuspendModal('Tutor ID no. {{ $tutor->id }}?', 'tutor', {{ $tutor->id }})" class="text-red-500 hover:text-red-800 cursor-pointer">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <form id="deleteTutor" action="{{ route('admin.tutor.delete') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="tutorIdToDelete" id="tutorIdToDelete">   
            </form>

            