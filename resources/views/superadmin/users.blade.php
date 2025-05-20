@section('title-header', 'Users')

<x-dashboard.layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table Daftar User Start -->
                <div x-data="{
                    openModal: false,
                    openEditModal: {{ isset($showEditModal) && $showEditModal ? 'true' : 'false' }},
                    openDeleteModal: false
                }" class="col-span-12 xl:col-span-8">
                    <div
                        class="rounded-xl border border-stroke bg-white px-5 pb-10 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-5 -z-10">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-black dark:text-white">Daftar Pengguna</h4>
                            {{-- <button data-modal-target="add-user" data-modal-toggle="add-user"
                                class="px-4 py-2 text-white rounded-lg bg-primary">Tambah</button> --}}
                        </div>


                        {{-- table --}}
                        <div class="h-full max-w-full overflow-x-auto rounded-sm -z-50">
                            <table class="w-full border-collapse rounded-sm table-auto">
                                <thead>
                                    <tr class="text-center bg-gray-100">
                                        <th class="p-3 text-sm font-medium">Nama</th>
                                        <th class="p-3 text-sm font-medium">Email</th>
                                        <th class="p-3 text-sm font-medium sm:table-cell">Role</th>
                                        <th class="p-3 text-sm font-medium sm:table-cell">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-center divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-3 font-medium text-black dark:text-white">{{ $user->username }}
                                            </td>
                                            <td class="p-3 font-medium text-meta-3">{{ $user->email }}</td>
                                            <td class="p-3 font-medium text-black sm:table-cell dark:text-white">
                                                {{ $user->role }}</td>
                                            </td>
                                            <td class="p-3 sm:table-cell">
                                                <div x-data="{ open: false }" class="inline-block text-left">
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
                                                        class="absolute z-40 w-32 mt-2 bg-white border rounded shadow-lg right-2">

                                                        {{-- BUTTON UPDATE --}}
                                                        <a href="{{ route('superadmin.user.edit', $user->id) }}"
                                                            class="block">
                                                            <x-dashboard.button-icon color="blue" text="Edit"
                                                                method="PUT">
                                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                                                </svg>
                                                            </x-dashboard.button-icon>
                                                        </a>

                                                        {{-- BUTTON DELETE --}}
                                                        <x-dashboard.button-icon color="red" text="Delete"
                                                            method="DELETE"
                                                            action="{{ route('superadmin.user.delete', $user->id) }}"
                                                            id_row="{{ $user->id }}">
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
                                    <!-- Tambah baris data lainnya di sini -->
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
    {{-- @include('components.modal.superadmin.add-user') --}}
    @include('components.modal.superadmin.update-user')

    @if (isset($showEditModal) && $showEditModal)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateModal = document.getElementById('update-user');
                const modal = new Modal(updateModal);
                modal.show();

                // Focus on first input when modal opens
                updateModal.addEventListener('shown.bs.modal', function() {
                    document.getElementById('update-name').focus();
                });
            });
        </script>
    @endif

</x-dashboard.layout>
