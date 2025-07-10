{{-- landing page --}}
<x-home.layout title="Home">
    @php
        // data gambar untuk careusel
        $images = [
            asset('images/carousel/gambar-1.jpg'),
            asset('images/carousel/gambar-2.jpg'),
            asset('images/carousel/gambar-3.jpg'),
            asset('images/carousel/gambar-4.jpg'),
            asset('images/carousel/gambar-5.jpg'),
        ];
    @endphp

    <x-home.carousel :images="$images"></x-home.carousel>
    <x-home.about></x-home.about>

    <x-home.waves-svg-top />
    <x-home.services :data="$data" />
    <x-home.contact></x-home.contact>
</x-home.layout>
