@php
    // handle images galleries
    $galleriesRaw = $data->galleries ?? '[]';
    if (substr($galleriesRaw, 0, 1) === '"' && substr($galleriesRaw, -1) === '"') {
        $galleriesRaw = substr($galleriesRaw, 1, -1);
    }
    $galleriesRaw = stripcslashes($galleriesRaw);
    $galleries = json_decode($galleriesRaw, true) ?? [];
@endphp

<x-home.layout title="Detail Cafe">
    <div class="relative">
        {{-- button back --}}
        <div class="mx-5 mt-20">
            <x-button.back-pages href="http://localhost:8000/home#services"></x-button.back-pages>
        </div>

        <section id="header" class="mt-2">
            <div class="w-[calc(100vw-3rem)] h-[50vh] mx-auto rounded-xl relative">
                <img src="{{ $data->image_profile }}" alt="Image Cafe"
                    class="object-cover w-full h-full shadow-xl rounded-xl brightness-50" loading="lazy">

                <div class="absolute top-16 left-16">
                    <h1 class="text-6xl font-semibold tracking-wider text-white">
                        {{ $data->name }}</h1>

                    <p class="mt-2 text-sm font-light tracking-wide text-white">{{ $data->address }}</p>

                    <button data-modal-target="booking-modal" data-modal-toggle="booking-modal"
                        class="mt-5 text-white bg-yellow-400 hover:bg-opacity-80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Booking
                        sekarang!</button>
                </div>
            </div>
        </section>

        <section id="body">

            <div class="flex items-center justify-center mt-5 gap-7">
                {{-- menu --}}
                <div class="flex flex-col items-center justify-center">
                    <a href="{{ route('menu-cafe', $data->cafe_id) }}"
                        class="block p-3 border rounded-full text-primaryBrown border-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 6h8m-8 4h12M6 14h8m-8 4h12" />
                        </svg>
                    </a>
                    <p class="text-sm font-medium text-center text-grayTheme">Menu</p>
                </div>

                {{-- Location --}}
                <div class="flex flex-col items-center justify-center">
                    <a href="https://www.google.com/maps?q={{ $data->location }}" target="_blank"
                        class="block p-3 border rounded-full text-primaryBrown border-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown">
                        <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                        </svg>

                    </a>
                    <p class="text-sm font-medium text-center text-grayTheme">Lokasi</p>
                </div>

                {{-- bookmark --}}
                <div class="flex flex-col items-center justify-center">
                    <button
                        class="p-3 border rounded-full text-primaryBrown border-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown">
                        {{-- unmark --}}
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                        </svg>

                        {{-- mark --}}
                        <svg class="hidden w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                        </svg>


                    </button>
                    <p class="text-sm font-medium text-center text-grayTheme">Bookmark</p>
                </div>
            </div>

            {{-- desk --}}
            <div class="mt-10">
                <p class="mx-20 italic tracking-wider text-center text-grayTheme"> <span
                        class="text-5xl font-extrabold text-slate-900">"</span>{{ $data->description }}</p>

                <h6 class="mt-2 font-medium text-center">~ {{ $data->name }}</h6>
            </div>

            {{-- Gallery --}}
            <div class="px-5 pt-10 md:px-20 md:pt-20">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold tracking-widest text-primaryBrown">Gallery</h1>
                    <span class="text-sm font-light tracking-wider text-grayTheme">Mari lihat beberapa foto-foto cafe
                        favoritmu.</span>
                </div>

                <div class="grid grid-cols-1 gap-4 mt-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse($galleries as $index => $url)
                        <div class="overflow-hidden rounded-lg group">
                            <img src="{{ $url }}" alt="Gallery image {{ $index + 1 }}"
                                class="object-cover w-full h-48 transition-all duration-500 transform brightness-75 group-hover:scale-110 group-hover:brightness-100"
                                loading="lazy">
                        </div>
                    @empty
                        <div class="py-8 text-center text-gray-500 col-span-full">
                            <p>No gallery images available</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- button booking --}}
            <div class="relative">
                <x-home.waves-svg-top />
                <div
                    class="absolute bottom-0 left-0 right-0 flex flex-col items-center justify-center max-w-3xl gap-3 p-5 mx-auto mb-5 md:px-20">
                    <p class="text-lg font-medium tracking-widest text-center text-white">Anda tertarik dan ingin
                        melakukan
                        booking
                        sekarang? Silahkan klik tombol dibawah ini 👇</p>
                    <button type="button" data-modal-target="booking-modal" data-modal-toggle="booking-modal"
                        class="text-yellow-400 bg-yellow-50 backdrop-blur-md hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Booking
                        Sekarang!</button>
                </div>
            </div>
        </section>


        {{-- chat cafe --}}
        <x-button.chat-cafe></x-button.chat-cafe>
    </div>
</x-home.layout>

@include('components.modal.user.booking', ['cafe_id' => $data->cafe_id])
