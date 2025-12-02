<div id="student-management" class="content-view">
                <h3 class="text-3xl font-bold text-[var(--dark-text)] mb-6">Student Management</h3>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-gray-600">Overview of student accounts.</p>
                        <button onclick="openAddAccountModal('student')" class="flex items-center bg-[var(--primary-color)] text-white text-sm font-semibold py-2 px-4 rounded-full hover:bg-teal-700 transition">
                            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add New Student
                        </button>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookings Made</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wallet Balance</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">#{{ $student->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">{{ $student->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @php
                                            $count = 0;
                                            foreach($bookings as $booking)
                                                if($booking->student_id == $student->id)
                                                     $count++;
                                            echo $count;
                                        @endphp
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">{{$student->balance}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4 flex items-center">
                                        <!-- Edit -->
                                        <a onclick="openStudentEditModal('{{ $student->id }}', '{{ $student->user->email }}', '{{ $student->balance }}', '{{ $student->user->name }}')" class="text-[var(--primary-color)] hover:text-teal-800 cursor-pointer">
                                            <i data-lucide="pencil" class="w-5 h-5"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a onclick="openSuspendModal('Student ID no. {{ $student->id }}?', 'student', {{ $student->id }})" class="text-red-500 hover:text-red-800 cursor-pointer">
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

            <form id="deleteStudent" action="{{ route('admin.student.delete') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="studentIdToDelete" id="studentIdToDelete">
            </form>

            <form id="editStudent" action="" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="studentIdToEdit" id="studentIdToEdit">
            </form>