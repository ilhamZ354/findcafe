<x-home.layout title="Transaksi">
    <div class="min-h-[55vh] px-5 my-20 md:px-10">
        <div class="flex items-center justify-start w-full gap-2">
            {{-- button back --}}
            <x-button.back-pages href="http://localhost:8000/home"></x-button.back-pages>

            <h3 class="text-xl tracking-wide text-primaryBrown">Transaksi</h3>
        </div>

        {{-- @dd($transactions) --}}

        <div class="rounded-xl pt-6 shadow-default sm:px-7.5 xl:pb-5 -z-10 overflow-x-auto">
            {{-- table --}}
            <table class="min-w-full border-collapse table-auto rounded-xl">
                <thead>
                    <tr class="text-center bg-gray-100">
                        <th class="p-3 text-sm font-medium">No.</th>
                        <th class="p-3 text-sm font-medium">Cafe</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Atas Nama</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Catatan</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Nominal</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Tanggal Booking</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Status</th>
                        <th class="p-3 text-sm font-medium sm:table-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-center divide-y divide-gray-200">
                    @if (isset($transactions) && $transactions->isNotEmpty())
                        @foreach ($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                {{-- no --}}
                                <td class="p-3 font-medium text-black">
                                    {{ $loop->iteration }}</td>

                                {{-- cafe --}}
                                <td class="p-3 font-medium text-meta-3">{{ $transaction->cafe_name }}</td>
                                {{-- <td class="p-3">{{ $transaction->cafe_id }}</td> --}}

                                {{-- atas nama --}}
                                <td class="p-3 font-medium text-black sm:table-cell">
                                    {{ $transaction->name }}</td>

                                {{-- catatan --}}
                                <td class="p-3">
                                    {{ $transaction->catatan ?? '-' }}</td>

                                {{-- nominal --}}
                                <td class="p-3 font-medium text-meta-3">Rp
                                    {{ number_format($transaction->nominal, 0, ',', '.') }}</td>

                                {{-- tanggal booking --}}
                                <td class="p-3 sm:table-cell">
                                    {{ $transaction->tgl_booking }}</td>
                                {{-- <td class="p-3 sm:table-cell">
                                    {{ $transaction->tgl_booking->format('d F Y H:i') }}</td> --}}

                                {{-- status --}}
                                @php
                                    $classColorByStatus = [
                                        'cancelled' => 'bg-red-100 text-red-800 border-red-400',
                                        'completed' => 'bg-green-100 text-green-800 border-green-400',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-400',
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-400',
                                    ];

                                @endphp
                                <td class="p-3">
                                    <span
                                        class="text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border uppercase {{ $classColorByStatus[$transaction->status] }}">{{ $transaction->status }}</span>
                                </td>

                                {{-- aksi --}}
                                <td class="flex items-center justify-center gap-2 p-3">
                                    {{-- pay button --}}
                                    <button type="button" data-snap-token="{{ $transaction->snap_token }}"
                                        class="pay-button text-primaryBrown hover:text-white border border-primaryBrown hover:bg-primaryBrown focus:ring-4 focus:outline-none focus:ring-semiPrimaryBrown font-medium rounded-lg text-sm px-4 py-1.5 text-center me-2 mb-2 bg-lightPrimaryBrown/50 backdrop-blur-xl">Bayar
                                        Sekarang</button>


                                    {{-- cancel button --}}
                                    <button type="button"
                                        class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center me-2 mb-2 ">Batalkan</button>
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

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    const payButtons = document.querySelectorAll('.pay-button');
    const userId = @json(auth()->user()->id);

    payButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            // Ambil snap token dari dataset
            const snapToken = this.dataset.snapToken;

            // console.log(snapToken);

            snap.pay(snapToken, {
                // Optional
                onSuccess: function(result) {
                    /// Redirect ke halaman kamu sendiri
                    // $params = [
                    //     'status' => 'success',
                    //     'paid_at' => $result->transaction_time
                    // ]
                    window.location.href = `/transaksi?status=success`;
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /// Redirect ke halaman kamu sendiri
                    // $params = [
                    //     'status' => 'pending',
                    //     'paid_at' => $result->transaction_time
                    // ]
                    // window.location.href = `/transaksi?status=pending`;
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /// Redirect ke halaman kamu sendiri
                    window.location.href = `/transaksi?status=failed`;
                    console.log(result)
                }
            });
        });
    });
</script>
