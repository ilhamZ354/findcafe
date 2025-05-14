@php
    use Illuminate\Support\Str;

    $desk = "Lorem ipsum dolor sit amet
                                                    consectetur adipisicing elit. Asperiores
                                                    voluptate ullam praesentium ratione commodi aut suscipit cupiditate
                                                    non nemo officiis tempore nihil pariatur delectus dignissimos
                                                    doloribus, facere mollitia, sint cumque.";
@endphp

<x-home.layout title="Bookmark">
    <div class="min-h-[55vh] px-5 my-20 md:px-10">
        <div class="flex items-center justify-start w-full gap-2">
            {{-- button back --}}
            <x-button.back-pages href="http://localhost:8000/home"></x-button.back-pages>

            <h3 class="text-xl tracking-wide text-primaryBrown">Bookmark Cafe</h3>
        </div>


        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5 mt-5">
            <!-- ====== Table One Start -->
            <div class="col-span-12 xl:col-span-8">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach (range(1, 5) as $i)
                        <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="{{ route('detail-cafe', $i) }}">
                                <img class="rounded-t-lg" src="{{ asset('images/background-cafe.jpg') }}"
                                    alt="product image" />
                            </a>
                            <div class="px-5 py-5">
                                <a href="{{ route('detail-cafe', $i) }}">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900">
                                        Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                                    <p class="mt-2 text-sm text-grayTheme">
                                        {{ Str::words($desk, 20, '...') }}</p>
                                    <p class="mt-2 text-sm text-lightGrayTheme">Lokasi : <span class="text-gray-700">Jl.
                                            Uskup Agung No.2,
                                            Madras Hulu, Kec. Medan Polonia</span></p>
                                </a>
                                <div class="flex items-center mt-2.5 mb-5">
                                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    </div>
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-smms-3">5.0</span>
                                </div>
                                <div class="flex items-center justify-end">
                                    <a href="{{ route('detail-cafe', $i) }}"
                                        class="text-white bg-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Lihat
                                        lainnya</a>
                                </div>
                            </div>
                        </div>

                        {{-- </a> --}}
                    @endforeach
                </div>
            </div>
            <!-- ====== Table One End -->
        </div>
    </div>

</x-home.layout>
