@php
    $typeMenus = ['All', 'makanan', 'minuman'];

    // mengambil cafe id
    $path = request()->path();
    $cafeId = substr($path, strrpos($path, '/') + 1);

    // mengambil type dari url
    $currentType = request()->query('type');
@endphp

<x-home.layout title="Menu Cafe">
    <div class="px-5 my-20 md:px-10 min-h-[55vh]">
        <div class="flex items-center justify-start w-full gap-2">
            {{-- button back --}}
            <x-button.back-pages href="{{ url('/detail-cafe/' . $cafeId) }}"></x-button.back-pages>
            <h3 class="text-xl tracking-wide text-primaryBrown">Menu Cafe</h3>
        </div>

        {{-- parameter --}}
        <form class="mt-10" method="GET" action="{{ url('/menu-cafe/' . $cafeId) }}">
            <label for="typeMenus" class="block mb-2 text-sm font-medium text-primaryBrown md:mx-5">
                Jenis Menu
            </label>
            <select id="type" name="type" onchange="this.form.submit()"
                class="block px-3 py-2 border rounded-md shadow-sm w-44 text-primaryBrown border-primaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown">
                @foreach ($typeMenus as $typeMenu)
                    <option value="{{ $typeMenu }}"
                        {{ $typeMenu == request('type') ? 'selected' : '' }}>{{ $typeMenu }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="grid grid-cols-1 gap-4 mt-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($menus as $menu)
                <div
                    class="flex items-start p-4 space-x-4 transition-shadow duration-300 border rounded-lg shadow-md border-primaryBrown bg-lightPrimaryBrown hover:shadow-lg">
                    <img src="{{ isset($menu['image']) && $menu['image'] && filter_var($menu['image'], FILTER_VALIDATE_URL)
                        ? $menu['image']
                        : (isset($menu['image']) && $menu['image']
                            ? asset('storage/menu-cafe_images/' . $menu['image'])
                            : 'https://via.placeholder.com/150') }}"
                        alt="{{ $menu['name'] }}" class="flex-shrink-0 object-cover w-20 h-20 mr-2 rounded-lg">
                    <div>
                        <h2 class="text-lg font-medium tracking-wide text-primaryBrown">{{ $menu['name'] }}</h2>
                        <p class="text-sm font-light text-semiPrimaryBrown">{{ $menu['description'] }}</p>
                        <p class="mt-1 font-semibold text-primaryBrown">Rp
                            {{ number_format($menu['harga'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-3 p-10 text-center text-gray-500">
                    <p>Tidak ada menu yang  tersedia.</p>
                </div>
            @endforelse
        </div>

        {{-- chat cafe --}}
        <x-button.chat-cafe cafe_id="{{ $cafe_id }}"
            sum_notification="{{ $sum_notification }}">
        </x-button.chat-cafe>
    </div>
</x-home.layout>
