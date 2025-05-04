@section('title-header', 'Dashboard')

<x-layout>
    <div class="bg-brown-500 p-6">
        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <!-- Left Column -->
                <div>
                    <!-- Hero Image -->
                    <div class="rounded-lg overflow-hidden aspect-video mb-6">
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Dummy Hero Image" class="w-full h-full object-cover">
                    </div>
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-3 mb-6 justify-items-center">
                        <a href="/dashboard/cafe-detail/menu-cafe"
                            class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-primary-dark transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </a>
                        <a href="https://www.google.com/maps?q=Jl.+Uskup+Agung+No.2,+Madras+Hulu,+Medan+Polonia"
                            target="_blank" rel="noopener noreferrer"
                            class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-primary-dark transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                        <button x-data="{ bookmarked: false }" @click="bookmarked = !bookmarked"
                            class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" :fill="bookmarked ? 'currentColor' : 'none'"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Booking Button -->
                    <a href="#"
                        class="block bg-primary text-center text-white font-bold py-4 px-6 rounded-full mb-6">
                        Booking
                    </a>
                </div>

                <!-- Right Column -->
                <div class="relative">
                    <!-- Chat icon button -->
                    <div class="mb-4">
                        <a href="/dashboard/cafe-detail/cafe-chat"
                            class="absolute top-0 right-0 bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8-1.64 0-3.168-.395-4.436-1.085L3 21l1.24-3.718C3.459 15.983 3 14.04 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </a>
                    </div>

                    <!-- Gallery -->
                    <h2 class="text-2xl font-bold mb-4">Gallery</h2>
                    <div class="grid grid-cols-3 gap-4">
                        @for ($i = 1; $i <= 4; $i++)
                            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                alt="Gallery Image" class="rounded-lg w-full h-48 object-cover">
                        @endfor
                    </div>

                    <!-- About Section -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold mb-4 mt-4">About</h2>
                        <p class="text-gray-700">
                            This is a dummy description about the cafe. Enjoy the best coffee and cozy atmosphere at
                            Dummy Daya!
                        </p>
                    </div>

                    <!-- Reviews -->
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Reviews</h2>
                        @for ($j = 1; $j <= 3; $j++)
                            <div class="bg-gray-100 p-4 mb-4 rounded-lg">
                                <div class="flex items-center mb-2 w-full">
                                    <img src="https://i.pravatar.cc/100?img={{ $j }}" alt="User Avatar"
                                        class="w-8 h-8 rounded-full mr-2 flex-shrink-0">
                                    <span class="font-semibold flex-grow">User {{ $j }}</span>
                                    <div class="flex ml-auto items-center space-x-1 bg-gray-200 px-2">
                                        <span>{{ rand(3, 5) }}/5</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0="
                                                0.951-.69l1.519-4.674z" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-gray-700">This is a sample review comment for Dummy Daya cafe.</p>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout>
