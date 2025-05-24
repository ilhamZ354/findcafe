@php
    $typeMenus = ['All', 'Makanan', 'Minuman'];
@endphp


@section('title-header', 'Dashboard')

<x-dashboard.layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table Menu Cafe Start -->
                <div x-data="{
                    openModal: false,
                    openEditModal: {{ isset($showModalEdit) && $showModalEdit ? 'true' : 'false' }},
                    openDeleteModal: false
                }" class="col-span-12 xl:col-span-8">
                    <div
                        class="rounded-xl border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-5 -z-10">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-black dark:text-white">Menu Cafe</h4>
                            <button data-modal-target="add-menu" data-modal-toggle="add-menu"
                                class="px-4 py-2 text-white rounded-lg bg-primary">Tambah</button>
                        </div>

                        {{-- parameter filter --}}
                        <form class="my-10" method="GET" action="{{ route('cafe.menu', Auth::id()) }}">
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

                        {{-- table --}}
                        <div class="h-full max-w-full overflow-x-auto rounded-sm -z-50">
                            <table class="w-full border-collapse rounded-sm table-auto">
                                <thead>
                                    <tr class="text-center bg-gray-100">
                                        <th class="p-3 text-sm font-medium">Tipe</th>
                                        <th class="p-3 text-sm font-medium">Nama</th>
                                        <th class="p-3 text-sm font-medium sm:table-cell">Deskripsi</th>
                                        <th class="p-3 text-sm font-medium sm:table-cell">Harga</th>
                                        <th class="p-3 text-sm font-medium sm:table-cell">Gambar</th>
                                        <th class="p-3 text-sm font-medium sm:table-cell">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($menus as $menuItem)
                                        @php
                                            $imagePath = Str::startsWith($menuItem->image, ['http://', 'https://'])
                                                ? $menuItem->image
                                                : asset('storage/' . $menuItem->image);
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            {{-- type --}}
                                            <td class="p-3 font-medium text-black dark:text-white">
                                                @if ($menuItem->type == 'makanan')
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-blue-400">{{ $menuItem->type }}</span>
                                                @else
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-red-400">{{ $menuItem->type }}</span>
                                                @endif
                                            </td>

                                            {{-- name --}}
                                            <td class="p-3 font-medium text-meta-3">{{ $menuItem->name }}</td>

                                            {{-- description --}}
                                            <td class="p-3 font-medium text-black sm:table-cell dark:text-white">
                                                {{ $menuItem->description }}
                                            </td>

                                            {{-- price --}}
                                            <td class="p-3 font-medium text-meta-3">Rp
                                                {{ number_format($menuItem->harga, 0, ',', '.') }}</td>

                                            {{-- image --}}
                                            <td class="p-3">
                                                <img src="{{ $imagePath }}" alt="{{ $menuItem->name }}"
                                                    class="object-cover w-16 h-16 rounded" />
                                            </td>

                                            {{-- action --}}
                                            <td class="p-3 sm:table-cell">
                                                <div x-data="{ open: false }" class="inline-block text-left ">
                                                    <button @click="open = !open"
                                                        class="p-2 rounded-full hover:bg-gray-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5 text-gray-500" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <circle cx="10" cy="5" r="2" />
                                                            <circle cx="10" cy="10" r="2" />
                                                            <circle cx="10" cy="15" r="2" />
                                                        </svg>
                                                    </button>

                                                    <div x-show="open" @click.away="open = false"
                                                        class="absolute right-0 z-40 w-32 mt-2 bg-white border rounded shadow-lg">

                                                        {{-- BUTTON UPDATE --}}
                                                        <a href="{{ route('cafe.menu.edit', $menuItem->id) }}"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-blue-500 hover:bg-gray-100">
                                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                                            </svg>

                                                            Edit
                                                        </a>

                                                        {{-- BUTTON DELETE --}}
                                                        <x-dashboard.button-icon color="red" text="Delete"
                                                            method="DELETE"
                                                            action="{{ route('cafe.menu.delete', $menuItem->id) }}"
                                                            id_row="{{ $menuItem->id }}">
                                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                            </svg>
                                                        </x-dashboard.button-icon>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- modal -->
    @include('components.modal.cafe.add-menu')

    @if (isset($menu))
        @include('components.modal.cafe.update-menu')
    @endif

    @if (isset($showModalEdit) && $showModalEdit)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateModal = document.getElementById('update-menu');
                const modal = new Modal(updateModal);
                modal.show();

                // Focus on first input when modal opens
                updateModal.addEventListener('shown.bs.modal', function() {
                    document.querySelector('#update-menu input[name="name"]').focus();
                });
            });
        </script>
    @endif

</x-dashboard.layout>
