<x-home.layout title="Transaksi">
    <div class="min-h-[55vh] px-5 my-20 md:px-10">
        <div class="flex items-center justify-start w-full gap-2">
            {{-- button back --}}
            <x-button.back-pages href="http://localhost:8000/home"></x-button.back-pages>

            <h3 class="text-xl tracking-wide text-primaryBrown">Transaksi</h3>
        </div>


        <div class="rounded-xl pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-5 -z-10">
            {{-- table --}}
            <table class="min-w-full overflow-x-auto border-collapse table-auto rounded-xl">
                <thead>
                    <tr class="text-center bg-gray-100">
                        <th class="p-3 text-sm font-medium">User</th>
                        <th class="p-3 text-sm font-medium">Cafe</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Name</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Catatan</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Nominal</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Tanggal Booking</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Status</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Snap Token</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-center divide-y divide-gray-200">
                    @if (isset($transactions) && $transactions->isEmpty())
                        @foreach ($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-medium text-black dark:text-white">
                                    {{ $transaction->user_id }}</td>
                                <td class="p-3 font-medium text-meta-3">{{ $transaction->cafe_id }}</td>
                                <td class="p-3 font-medium text-black sm:table-cell dark:text-white">
                                    {{ $transaction->name }}</td>
                                <td class="p-3 font-medium text-black dark:text-white">
                                    {{ $transaction->catatan }}</td>
                                <td class="p-3 font-medium text-meta-3">{{ $transaction->nominal }}</td>
                                <td class="p-3 font-medium text-black sm:table-cell dark:text-white">
                                    {{ $transaction->tgl_booking }}</td>
                                <td class="p-3 font-medium text-black dark:text-white">
                                    {{ $transaction->status }}</td>
                                <td class="p-3 font-medium text-meta-3">{{ $transaction->snap_token }}</td>
                                </td>
                                <td class="p-3 sm:table-cell">
                                    <div x-data="{ open: false }" class="relative inline-block text-left">
                                        <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <circle cx="10" cy="5" r="2" />
                                                <circle cx="10" cy="10" r="2" />
                                                <circle cx="10" cy="15" r="2" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false"
                                            class="absolute right-0 z-40 w-32 mt-2 bg-white border rounded shadow-lg">

                                            {{-- BUTTON UPDATE --}}
                                            <a href="{{ route('superadmin.transaksi.edit', $transaction->id) }}"
                                                class="block">
                                                <x-dashboard.button-icon color="blue" text="Edit" method="PUT">
                                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                                    </svg>
                                                </x-dashboard.button-icon>
                                            </a>

                                            {{-- BUTTON DELETE --}}
                                            <x-dashboard.button-icon color="red" text="Delete" method="DELETE"
                                                action="{{ route('superadmin.transaksi.delete', $transaction->id) }}"
                                                id_row="{{ $transaction->id }}">
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
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
                    @else
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 italic font-medium text-black" colspan="9">
                                Anda belum melakukan transaksi
                            </td>
                        </tr>
                    @endif
                    <!-- Tambah baris data lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>
</x-home.layout>
