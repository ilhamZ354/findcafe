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
                                    <th class="p-3 text-sm font-medium">No.</th>
                                    <th class="p-3 text-sm font-medium">Nama Pelanggan</th>
                                    <th class="p-3 text-sm font-medium">Atas Nama</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Catatan</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Nominal</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Tanggal Booking</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Status</th>
                                    <th class="p-3 text-sm font-medium sm:table-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($transactions as $transaction)
                                    <tr
                                        class="<?= $transaction->payments->status === 'completed' ? 'bg-green-100' : ($transaction->payments->status === 'cancelled' ? 'bg-red-50' : 'hover:bg-gray-50') ?>">

                                        {{-- no. --}}
                                        <td class="p-3 font-medium">{{ $loop->iteration }}</td>

                                        {{-- nama pelanggan --}}
                                        <td class="p-3 font-medium">{{ $transaction->user->name }}</td>

                                        {{-- atas nama --}}
                                        <td class="p-3 font-medium">{{ $transaction->name }}</td>

                                        {{-- catatan --}}
                                        <td class="p-3 text-center text-black sm:table-cell max-w-32">
                                            {{ $transaction->catatan }}</td>
                                        </td>

                                        {{-- nominal --}}
                                        <td class="p-3 font-bold break-words text-meta-3">Rp
                                            {{ number_format($transaction->nominal, 0, ',', '.') }}</td>

                                        {{-- tanggal booking --}}
                                        <td class="p-3">
                                            {{ $transaction->tgl_booking->format('d F Y') }}</td>

                                        {{-- status --}}
                                        <td
                                            class="p-3 uppercase <?= $transaction->status === 'paid' ? 'text-green-500' : 'text-red-500' ?>">
                                            @if ($transaction->status === 'paid')
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-green-400">{{ $transaction->status }}</span>
                                            @else
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-red-400">{{ $transaction->status }}</span>
                                            @endif
                                        </td>

                                        {{-- aksi --}}
                                        @if ($transaction->payments->status == 'completed')
                                            <td></td>
                                        @else
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

                                                        @if ($transaction->status === 'paid')
                                                            {{-- button selesai --}}
                                                            <form
                                                                action="{{ route('cafe.transaksi.finish', $transaction->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    onclick="confirmSelesai({{ $transaction->id }})"
                                                                    {{ \Carbon\Carbon::parse($transaction->tgl_booking)->lt(now()->startOfDay()) ? '' : 'disabled' }}
                                                                    class="flex items-center w-full px-4 py-2 text-sm text-green-500 hover:bg-gray-100 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-white">
                                                                    <svg class="w-6 h-6" aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24" fill="none"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke="currentColor"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                    </svg>

                                                                    Selesai
                                                                </button>
                                                            </form>

                                                            {{-- Batalkan --}}
                                                            <form
                                                                action="{{ route('cafe.transaksi.cancel', $transaction->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="flex items-center w-full px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                                                    <svg class="w-6 h-6 " aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24" fill="none"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke="currentColor"
                                                                            stroke-linecap="round" stroke-width="2"
                                                                            d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                    </svg>

                                                                    Batalkan
                                                                </button>
                                                            </form>
                                                        @else
                                                            {{-- BUTTON DELETE --}}
                                                            <x-dashboard.button-icon color="red" text="Delete"
                                                                method="DELETE"
                                                                action="{{ route('cafe.transaksi.delete', $transaction->id) }}"
                                                                id_row="{{ $transaction->id }}">
                                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                                </svg>
                                                            </x-dashboard.button-icon>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if (count($transactions) !== 0)
                            <div class="px-4 mt-7">
                                {{ $transactions->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-dashboard.layout>
