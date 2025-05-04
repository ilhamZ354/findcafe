<x-layout>
    <!-- My Profile Content Page -->
    <div class="bg-white min-h-screen">
        <!-- Profile Container -->
        <div class="max-w-5xl mx-auto p-6">
            <!-- Edit Profile Button -->
            <div class="mb-8 flex justify-between">
                <a href="/edit-profile"
                    class="bg-brown-700 hover:bg-brown-800 text-white font-medium py-2 px-6 rounded-md transition-colors">
                    Edit Profile
                </a>
                <button id="toggleEditBtn"
                    class="bg-primary hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors">
                    Edit
                </button>
            </div>

            <!-- Profile Content -->
            <form class="bg-amber-100 rounded-lg p-8" action="/save-profile" method="POST">
                <!-- Profile Picture Section -->
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <img src="https://i.pravatar.cc/100?img=1" alt="Profile Picture"
                            class="w-36 h-36 rounded-full object-cover border-4 border-white">
                        <button type="button"
                            class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="space-y-4">
                    <!-- Email Field -->
                    <div class="bg-white rounded-md p-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="cafehunt@gmail.com" disabled
                            class="text-gray-900 w-full border border-gray-300 rounded-md px-3 py-2 disabled:bg-gray-100" />
                    </div>

                    <!-- Password Field -->
                    <div class="bg-white rounded-md p-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                        <input type="password" name="password" value="password" disabled
                            class="text-gray-900 w-full border border-gray-300 rounded-md px-3 py-2 disabled:bg-gray-100" />
                    </div>

                    <!-- Full Name -->
                    <div class="bg-white rounded-md p-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Full Name</label>
                        <input type="text" name="name" value="Jane Doe" disabled
                            class="text-gray-900 w-full border border-gray-300 rounded-md px-3 py-2 disabled:bg-gray-100" />
                    </div>

                    <!-- Phone Number -->
                    <div class="bg-white rounded-md p-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone" value="+62 812 3456 7890" disabled
                            class="text-gray-900 w-full border border-gray-300 rounded-md px-3 py-2 disabled:bg-gray-100" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-8 flex justify-center">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-md transition-colors disabled:opacity-50"
                        disabled id="saveBtn">
                        Save Changes
                    </button>
                </div>

                <!-- Logout Button -->
                <div class="mt-4 flex justify-center">
                    <button type="button"
                        class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                        Logout
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
