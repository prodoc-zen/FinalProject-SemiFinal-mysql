        <div id="bookings" class="content-view">
                <h3 class="text-3xl font-bold text-[var(--dark-text)] mb-6">Booking Management</h3>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-gray-600">Detailed list of all tutoring sessions, their current status, and related parties.</p>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">#{{ $booking->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->tutor->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->student->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->scheduled_at }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->subject->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = match($booking->status) {
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'canceled' => 'bg-red-100 text-red-800',
                                                'ongoing' => 'bg-green-100 text-green-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4 flex items-center">
                                        <!-- Edit -->
                                        <a onclick="openBookingEditModal('{{ $booking->id }}', '{{ $booking->status }}')" class="text-[var(--primary-color)] hover:text-teal-800 cursor-pointer">
                                            <i data-lucide="pencil" class="w-5 h-5"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a onclick="openSuspendModal('Booking ID no. {{ $booking->id }}?', 'booking', {{ $booking->id }})" class="text-red-500 hover:text-red-800 cursor-pointer">
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

            <form id="deleteBooking" action="{{ route('admin.booking.delete') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="bookingIdToDelete" id="bookingIdToDelete">
            </form>
