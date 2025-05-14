<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<x-home.header>
    Home
</x-home.header>

<body>
    @php
        $images = [
            asset('images/carousel/gambar-1.png'),
            asset('images/carousel/gambar-2.png'),
            asset('images/carousel/gambar-3.png'),
            asset('images/carousel/gambar-4.png'),
            asset('images/carousel/gambar-5.png'),
        ];
    @endphp

    <x-home.navbar></x-home.navbar>
    <x-home.carousel :images="$images"></x-home.carousel>
    <x-home.about></x-home.about>

    <x-home.waves-svg-top />
    <x-home.services></x-home.services>
    <x-home.contact></x-home.contact>



    <footer class="shadow-sm bg-semiPrimaryBrown">
        <div class="w-full max-w-screen-xl p-4 mx-auto md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 space-x-3 sm:mb-0 rtl:space-x-reverse">
                    <img src="{{ asset('images/logo-cafe-hunt.png') }}" class="h-20" alt="Cafe Hunt Logo" />
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0 ">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Home</a>
                    </li>
                    <li>
                        <a href="#about" class="hover:underline me-4 md:me-6">Tentang</a>
                    </li>
                    <li>
                        <a href="#services" class="hover:underline me-4 md:me-6">Layanan</a>
                    </li>
                    <li>
                        <a href="#contact" class="hover:underline">Kontak</a>
                    </li>
                </ul>
            </div>
            <hr class="my-1 border-gray-200 sm:mx-auto lg:my-1" />
            <span class="block text-sm text-white sm:text-center">© {{ date('Y') }}. All
                Rights Reserved.</span>
        </div>
    </footer>



    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
