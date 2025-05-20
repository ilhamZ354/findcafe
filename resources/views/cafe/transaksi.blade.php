@section('title-header', 'Dashboard')

<x-dashboard.layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table Transaksi Cafe Start -->
                <div x-data="{
                    openModal: false,
                    openEditModal: {{ isset($showModalEdit) && $showModalEdit ? 'true' : 'false' }},
                    openDeleteModal: false
                }" class="col-span-12 xl:col-span-8">
                    <div
                        class="rounded-xl border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-5 -z-10">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-black dark:text-white">Booking Cafe</h4>
                            {{-- <button data-modal-target="add-transaksi" data-modal-toggle="add-transaksi"
                                class="px-4 py-2 text-white rounded-lg bg-primary">Tambah</button> --}}
                        </div>

                        {{-- table --}}
                        <table class="min-w-full overflow-x-auto border-collapse rounded-sm table-auto">
                            <thead>
                                <tr class="text-center bg-gray-100">
                                    <th class="p-3 text-sm font-medium">Nama Pelanggan</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Catatan</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Nominal</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Tanggal Booking</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Status</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($transactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        {{-- nama pelanggan --}}
                                        <td class="p-3 font-medium text-meta-3">{{ $transaction->name }}</td>

                                        {{-- catatan --}}
                                        <td class="p-3 font-medium text-center text-black sm:table-cell">
                                            {{ $transaction->catatan }}</td>
                                        </td>

                                        {{-- nominal --}}
                                        <td class="p-3 font-medium text-meta-3">Rp
                                            {{ number_format($transaction->nominal, 0, ',', '.') }}</td>

                                        {{-- tanggal booking --}}
                                        <td class="p-3 font-medium text-meta-3">
                                            {{ $transaction->tgl_booking->format('d F Y') }}</td>

                                        {{-- status --}}
                                        <td class="p-3 font-medium text-meta-3">{{ $transaction->status }}</td>

                                        {{-- aksi --}}
                                        <td class="p-3 sm:table-cell">
                                            <div x-data="{ open: false }" class="relative inline-block text-left">
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
                                                    {{-- <a href="{{ route('cafe.transaksi.editTC', $transaction->id) }}"
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
                                                    </a> --}}

                                                    {{-- BUTTON DELETE --}}
                                                    <x-dashboard.button-icon color="red" text="Delete"
                                                        method="DELETE"
                                                        action="{{ route('cafe.transaksi.deleteTC', $transaction->id) }}"
                                                        id_row="{{ $transaction->id }}">
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
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- modal -->
    {{-- @include('components.modal.cafe.add-transaksi')

    @if (isset($transaction))
        @include('components.modal.cafe.update-transaksi')
    @endif

    @if (isset($showModalEdit) && $showModalEdit)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateModal = document.getElementById('update-transaksi');
                const modal = new Modal(updateModal);
                modal.show();

                // Focus on first input when modal opens
                updateModal.addEventListener('shown.bs.modal', function() {
                    document.querySelector('#update-transaksi input[name="name"]').focus();
                });
            });
        </script>
    @endif --}}

</x-dashboard.layout>
