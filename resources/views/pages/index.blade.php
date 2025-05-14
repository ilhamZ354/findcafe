<x-home.layout title="Home">
    @php
        $images = [
            asset('images/carousel/gambar-1.png'),
            asset('images/carousel/gambar-2.png'),
            asset('images/carousel/gambar-3.png'),
            asset('images/carousel/gambar-4.png'),
            asset('images/carousel/gambar-5.png'),
        ];
    @endphp

    <x-home.carousel :images="$images"></x-home.carousel>
    <x-home.about></x-home.about>

    <x-home.waves-svg-top />
    <x-home.services :data="$data" />
    <x-home.contact></x-home.contact>
</x-home.layout>
