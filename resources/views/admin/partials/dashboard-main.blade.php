<div id="main-dashboard" class="content-view">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Stat Card 1: Total Users -->
                    <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-[var(--primary-color)] transition duration-300 hover:shadow-xl col-span-1 sm:col-span-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Users (Tutors & Students)</p>
                                <p class="text-3xl font-extrabold text-[var(--dark-text)] mt-1">{{ $users_count-1 }}</p>
                            </div>
                            <i data-lucide="users" class="w-8 h-8 text-[var(--primary-color)] opacity-70"></i>
                        </div>
                        <p class="text-xs text-green-500 mt-2">All users of Tuturo</p>
                    </div>

                    <!-- Stat Card 2: Active Tutors -->
                    <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-yellow-500 transition duration-300 hover:shadow-xl col-span-1 sm:col-span-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Active Tutors</p>
                                <p class="text-3xl font-extrabold text-[var(--dark-text)] mt-1">{{ $tutors_count }}</p>
                            </div>
                            <i data-lucide="award" class="w-8 h-8 text-yellow-500 opacity-70"></i>
                        </div>
                        <p class="text-xs text-yellow-600 mt-2">Approved & currently teaching</p>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 border-yellow-500 transition duration-300 hover:shadow-xl col-span-1 sm:col-span-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Active Students</p>
                                <p class="text-3xl font-extrabold text-[var(--dark-text)] mt-1">{{ $students_count }}</p>
                            </div>
                            <i data-lucide="graduation-cap" class="w-8 h-8 text-yellow-500 opacity-70"></i>
                        </div>
                        <p class="text-xs text-yellow-600 mt-2">Approved & currently studying</p>
                    </div>

                    <!-- Removed Pending Approvals and Q3 Revenue -->
                </div>

                <!-- Recent Activity Table (Kept as a useful dashboard element) -->
                <div class="bg-white p-6 rounded-xl shadow-lg mt-6">
                    <h3 class="text-xl font-semibold mb-4 text-[var(--dark-text)]">Recent Account Signups</h3>
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                @if($user->role != 'admin')
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">#{{ $user->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->role }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4 flex items-center">

                                        <!-- Delete -->
                                        <a onclick="openSuspendModal('User ID no. {{ $user->id }}?', 'user', {{ $user->id }})" class="text-red-500 hover:text-red-800 cursor-pointer">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </a>
                                    </td>
                                    </tr>
                                @endif
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <form id="deleteUser" action="{{ route('admin.user.delete') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="userIdToDelete" id="userIdToDelete">
            </form>

            <form id="editUser" action="" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="userIdToEdit" id="userIdToEdit">
            </form>

   