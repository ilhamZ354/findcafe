@props(['data'])

@php
    use Illuminate\Support\Str;

    $desk = "Lorem ipsum dolor sit amet
                                                    consectetur adipisicing elit. Asperiores
                                                    voluptate ullam praesentium ratione commodi aut suscipit cupiditate
                                                    non nemo officiis tempore nihil pariatur delectus dignissimos
                                                    doloribus, facere mollitia, sint cumque.";
@endphp

<section id="services" class="pb-20 -mt-10 md:-mt-20 bg-semiPrimaryBrown">
    <div class="max-w-3xl mx-auto text-center ">
        <h1 class="text-4xl font-bold tracking-widest text-white">Layanan Kami</h1>
        <span class="text-sm font-light tracking-wider text-lightGrayTheme">Mari mulai mencari cafe favoritmu dan
            booking
            sekarang!</span>
    </div>

    <div class="mt-5">
        <main>
            <div class="p-4 mx-auto max-w-screen-2xl md:p-6 md:px-8 2xl:p-10">
                {{-- Search --}}
                <x-form.search-input />

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                    <!-- ====== Table One Start -->
                    <div class="col-span-12 xl:col-span-8">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-2xl font-medium text-white">
                                Explore Cafes
                            </h4>
                        </div>

                        @if ($data->isNotEmpty() && count($data) > 0)
                            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                                @foreach ($data as $cafe)
                                    <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <a
                                            href="{{ Auth::check() ? route('detail-cafe', $cafe->cafe_id) : route('login') }}">
                                            <img class="object-cover w-full rounded-t-lg h-60"
                                                src="{{ $cafe->image_profile }}" alt="product image" />
                                        </a>
                                        <div class="px-5 py-5">
                                            <a
                                                href="{{ Auth::check() ? route('detail-cafe', $cafe->cafe_id) : route('login') }}">
                                                <h5 class="text-xl font-semibold tracking-tight text-gray-900">
                                                    {{ $cafe->name }}</h5>
                                                <p class="mt-2 text-sm text-grayTheme">
                                                    {{ Str::words($cafe->description, 20, '...') }}</p>
                                                <p class="mt-2 text-sm text-lightGrayTheme">Lokasi : <span
                                                        class="text-gray-700">{{ $cafe->address }}</span></p>
                                            </a>
                                            @php
                                                $fullStars = floor($cafe->avg_rating); // Misal: 4.7 => 4
                                            @endphp

                                            <div class="flex items-center mt-2.5 mb-5">
                                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $fullStars ? 'text-yellow-300' : 'text-gray-300 dark:text-gray-600' }}"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 20" aria-hidden="true">
                                                            <path
                                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded ms-3">
                                                    {{ number_format($cafe->avg_rating, 1) }}
                                                </span>
                                            </div>

                                            <div class="flex items-center justify-end">
                                                <a href="{{ Auth::check() ? route('detail-cafe', $cafe->cafe_id) : route('login') }}"
                                                    class="text-white bg-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Lihat
                                                    lainnya</a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- </a> --}}
                                @endforeach
                            </div>
                        @else
                            <div class="flex items-center justify-center">
                                <p class="text-center text-white">Tidak ada data</p>
                            </div>
                        @endif
                    </div>
                    <!-- ====== Table One End -->
                </div>
            </div>
        </main>
    </div>
</section>
