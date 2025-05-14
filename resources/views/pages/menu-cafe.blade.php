@php
    $typeMenus = ['All', 'Makanan', 'Minuman'];
@endphp

<x-home.layout title="Menu Cafe">
    <div class="px-5 my-20 md:px-10 min-h-[55vh]">
        <div class="flex items-center justify-start w-full gap-2">
            {{-- button back --}}
            <x-button.back-pages href="http://localhost:8000/detail-cafe/{{ $id }}"></x-button.back-pages>

            <h3 class="text-xl tracking-wide text-primaryBrown">Menu Nama Cafe</h3>
        </div>


        {{-- parameter --}}
        <form class="mt-10">
            <label for="typeMenus" class="block mb-2 text-sm font-medium text-primaryBrown md:mx-5">
                Jenis Menu
            </label>

            <select id="typeMenus" name="typeMenus"
                class="block px-3 py-2 border rounded-md shadow-sm w-44 text-primaryBrown border-primaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown">
                @foreach ($typeMenus as $typeMenu)
                    <option value="{{ $typeMenu }}">{{ $typeMenu }}</option>
                @endforeach
            </select>
        </form>



        <div class="grid grid-cols-3 gap-3 mt-5">
            @foreach (range(1, 4) as $i)
                <div
                    class="flex items-start p-4 space-x-4 transition-shadow duration-300 border rounded-lg shadow-md border-primaryBrown bg-lightPrimaryBrown hover:shadow-lg">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                        alt="Menu" class="flex-shrink-0 object-cover w-20 h-20 mr-2 rounded-lg">
                    <div>
                        <h2 class="text-lg font-medium tracking-wide text-primaryBrown">Roti Alien</h2>
                        <p class="text-sm font-light text-semiPrimaryBrown">Roti kukus empuk, berwarna-warni (hijau
                            neon, biru laut, ungu
                            galaksi, pink pastel)</p>
                        <p class="mt-1 font-semibold text-primaryBrown">Rp 10.000</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- chat cafe --}}
        <x-button.chat-cafe></x-button.chat-cafe>
    </div>
</x-home.layout>
