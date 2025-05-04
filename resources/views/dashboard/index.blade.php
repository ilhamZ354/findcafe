@section('title-header', 'Dashboard')

<x-layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table One Start -->
                <div class="col-span-12 xl:col-span-8">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold text-black dark:text-white">
                            Explore Cafes
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach (range(1, 5) as $i)
                            <a href="/dashboard/cafe-detail" class="block">
                                <div
                                    class="bg-white rounded-lg shadow-lg overflow-hidden border border-stroke dark:border-strokedark dark:bg-boxdark hover:shadow-xl transition-shadow">
                                    <img src="{{ asset('images/background-cafe.jpg') }}" alt="Cafe Image"
                                        class="w-full h-40 object-cover">
                                    <div class="p-4">
                                        <h5 class="text-lg font-semibold text-black dark:text-white">Junction Café</h5>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Jl. Uskup Agung No.2, Madras Hulu, Kec. Medan Polonia
                                        </p>
                                        <div class="flex items-center mt-2">
                                            <span class="text-yellow-400 mr-1">★★★★★</span>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">(106)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- ====== Table One End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</x-layout>
