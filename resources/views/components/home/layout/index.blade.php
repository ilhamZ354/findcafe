@props(['title' => 'Home'])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<x-home.layout.header>
    {{ $title }}
</x-home.layout.header>

<body>

    <x-home.layout.navbar></x-home.layout.navbar>

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    <x-home.layout.footer></x-home.layout.footer>

    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
