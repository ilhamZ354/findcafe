@section('title-header', 'Dashboard')

<x-layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table Menu Cafe Start -->
                <div class="col-span-12 xl:col-span-8">
                    <div
                        class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-xl font-bold text-black dark:text-white">
                                Menu Cafe
                            </h4>
                            <button class="px-4 py-2 text-white bg-primary rounded-lg ">
                                Tambah
                            </button>
                        </div>
                        <div class="flex flex-col">
                            <div class="grid grid-cols-6 bg-gray-50 rounded-t-md p-3">
                                <div class="text-center text-gray-600 font-medium">Tipe</div>
                                <div class="text-center text-gray-600 font-medium">Nama</div>
                                <div class="text-center text-gray-600 font-medium">Deskripsi</div>
                                <div class="text-center text-gray-600 font-medium">Harga</div>
                                <div class="text-center text-gray-600 font-medium">Gambar</div>
                                <div class="text-center text-gray-600 font-medium">Aksi</div>
                            </div>

                            <div class="grid grid-cols-6 border-t border-gray-200 p-3">
                                <div class="text-center font-medium">3.5K</div>
                                <div class="text-center text-green-500 font-medium">$5,768</div>
                                <div class="text-center font-medium">590</div>
                                <div class="text-center text-blue-500 font-medium">4.8%</div>
                                <div class="text-center text-blue-500">[Image]</div>
                                <div x-data="{ open: false }"
                                    class="relative hidden items-center justify-center sm:flex">
                                    <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100">
                                        <!-- 3 dots icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <circle cx="10" cy="5" r="2" />
                                            <circle cx="10" cy="10" r="2" />
                                            <circle cx="10" cy="15" r="2" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg z-50">
                                        <a href="#"
                                            class="flex items-center px-4 py-2 text-sm text-blue-500 hover:bg-gray-100">
                                            <!-- edit icon -->
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="#"
                                            class="flex items-center px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                            <!-- delete icon -->
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-6 border-t border-gray-200 p-3">
                                <div class="text-center font-medium">2.2K</div>
                                <div class="text-center text-green-500 font-medium">$4,635</div>
                                <div class="text-center font-medium">467</div>
                                <div class="text-center text-blue-500 font-medium">4.3%</div>
                                <div class="text-center text-blue-500">[Image]</div>
                                <div x-data="{ open: false }"
                                    class="relative hidden items-center justify-center sm:flex">
                                    <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100">
                                        <!-- 3 dots icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <circle cx="10" cy="5" r="2" />
                                            <circle cx="10" cy="10" r="2" />
                                            <circle cx="10" cy="15" r="2" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 mt-2 w-32 bg-white border rounded shadow-lg z-50">
                                        <a href="#"
                                            class="flex items-center px-4 py-2 text-sm text-blue-500 hover:bg-gray-100">
                                            <!-- edit icon -->
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="#"
                                            class="flex items-center px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                            <!-- delete icon -->
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Table Menu Cafe End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</x-layout>
