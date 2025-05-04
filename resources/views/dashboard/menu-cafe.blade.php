@section('title-header', 'Dashboard')

<x-layout>
    <div class="bg-brown-100 p-6 min-h-screen">
        <!-- Main Content -->
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-6xl mx-auto mt-6">
            <!-- Back Button -->
            <a href="/dashboard/cafe-detail"
                class="inline-flex items-center mb-4 text-brown-700 hover:text-brown-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <h1 class="text-3xl font-bold text-brown-800">Menu Cafe [NamaCafe]</h1>
            </a>

            <!-- Menu Grid -->
            <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Menu Card 1 -->
                <div style="background:#DDBC95"
                    class="p-4 rounded-lg flex space-x-4 items-start shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="mr-2 w-20 h-20 rounded-lg object-cover flex-shrink-0">
                    <div>
                        <h2 class="font-bold text-white">Roti Alien</h2>
                        <p class="text-white text-sm">Roti kukus empuk, berwarna-warni (hijau neon, biru laut, ungu
                            galaksi, pink pastel)</p>
                        <p class="text-white font-semibold mt-1">Rp 10.000 – Rp 15.000/pcs</p>
                    </div>
                </div>

                <!-- Menu Card 2 -->
                <div style="background:#DDBC95"
                    class="bg-primary p-4 rounded-lg flex space-x-4 items-start shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="mr-2 w-20 h-20 rounded-lg object-cover flex-shrink-0">
                    <div>
                        <h2 class="font-bold text-white">Roti Alien</h2>
                        <p class="text-white text-sm">Roti kukus empuk, berwarna-warni (hijau neon, biru laut, ungu
                            galaksi, pink pastel)</p>
                        <p class="text-white font-semibold mt-1">Rp 10.000 – Rp 15.000/pcs</p>
                    </div>
                </div>

                <!-- Menu Card 3 -->
                <div style="background:#DDBC95"
                    class="bg-primary p-4 rounded-lg flex space-x-4 items-start shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="mr-2 w-20 h-20 rounded-lg object-cover flex-shrink-0">
                    <div>
                        <h2 class="font-bold text-white">Donat Galaxy</h2>
                        <p class="text-white text-sm">Donat dengan glasir berwarna gradasi galaxy dan taburan edible
                            glitter</p>
                        <p class="text-white font-semibold mt-1">Rp 12.000/pcs</p>
                    </div>
                </div>

                <!-- Menu Card 4 -->
                <div style="background:#DDBC95"
                    class="bg-primary p-4 rounded-lg flex space-x-4 items-start shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="mr-2 w-20 h-20 rounded-lg object-cover flex-shrink-0">
                    <div>
                        <h2 class="font-bold text-white">Kue Pelangi</h2>
                        <p class="text-white text-sm">Kue berlapis dengan warna-warni pelangi dan rasa buah yang berbeda
                            di setiap lapisan</p>
                        <p class="text-white font-semibold mt-1">Rp 18.000/slice</p>
                    </div>
                </div>

                <!-- Menu Card 5 -->
                <div style="background:#DDBC95"
                    class="bg-primary p-4 rounded-lg flex space-x-4 items-start shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="mr-2 w-20 h-20 rounded-lg object-cover flex-shrink-0">
                    <div>
                        <h2 class="font-bold text-white">Croissant Butter</h2>
                        <p class="text-white text-sm">Croissant lembut dan berlapis dengan rasa butter yang kaya</p>
                        <p class="text-white font-semibold mt-1">Rp 15.000/pcs</p>
                    </div>
                </div>

                <!-- Menu Card 6 -->
                <div style="background:#DDBC95"
                    class="bg-primary p-4 rounded-lg flex space-x-4 items-start shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="mr-2 w-20 h-20 rounded-lg object-cover flex-shrink-0">
                    <div>
                        <h2 class="font-bold text-white">Pie Buah</h2>
                        <p class="text-white text-sm">Pie dengan isian buah segar dan krispidan renyah di bagian luarnya
                        </p>
                        <p class="text-white font-semibold mt-1">Rp 20.000/pcs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
