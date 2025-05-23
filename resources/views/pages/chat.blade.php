<x-home.layout title="Chat Cafe" :footer="false" :navbar="false">
    <div class="flex items-center justify-center w-full h-screen bg-gray-700 bg-center bg-no-repeat bg-cover bg-blend-multiply"
        style="background-image: url('/images/background-cafe.jpg')" loading="lazy">

        <div class="flex flex-col w-1/2 max-w-2xl bg-white rounded-lg">
            <header class="flex items-center justify-start gap-3 px-4 py-1 rounded-t-lg bg-lightPrimaryBrown">
                <x-button.back-pages href="{{ route('home') }}#services" />
                <h1 class="text-2xl font-medium tracking-wide text-primaryBrown">Nama Cafe</h1>
            </header>
            <hr>

            {{-- Komponen Livewire --}}
            <livewire:chat-room :to-user-id="$toUserId" />
        </div>
    </div>
</x-home.layout>
