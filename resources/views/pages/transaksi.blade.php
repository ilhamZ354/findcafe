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
                                    {{ \Carbon\Carbon::parse($transaction->tgl_booking)->format('d F Y H:i') }}</td>

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
                                    @if ($transaction->status == 'pending')
                                        {{-- pay button --}}
                                        <button type="button" data-snap-token="{{ $transaction->snap_token }}"
                                            class="pay-button text-primaryBrown hover:text-white border border-primaryBrown hover:bg-primaryBrown focus:ring-4 focus:outline-none focus:ring-semiPrimaryBrown font-medium rounded-lg text-sm px-4 py-1.5 text-center me-2 mb-2 bg-lightPrimaryBrown/50 backdrop-blur-xl">Bayar
                                            Sekarang</button>


                                        {{-- cancel button --}}
                                        <form id="formCancel-{{ $transaction->id }}"
                                            action="{{ route('transaksi-user.cancel', $transaction->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" onclick="confirmCancel({{ $transaction->id }})"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center me-2 mb-2 ">Batalkan</button>
                                        </form>
                                    @elseif ($transaction->status == 'processing')
                                        <button type="button"
                                            {{ \Carbon\Carbon::parse($transaction->tgl_booking)->lt(now()->startOfDay()) ? '' : 'disabled' }}
                                            class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-50 font-medium rounded-lg text-sm px-4 py-1.5 text-center me-2 mb-2 disabled:opacity-50 disabled:cursor-not-allowed">Review
                                            & Rating</button>
                                    @endif
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

            @if (count($transactions) !== 0)
                <div class="px-4 mt-7">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="loadingOverlay" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill" />
        </svg>
        <span class="sr-only">Loading...</span>
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

            snap.pay(snapToken, {
                // Optional
                onSuccess: function(result) {
                    document.getElementById('loadingOverlay').classList.remove('hidden');
                    document.getElementById('loadingOverlay').classList.add('flex');

                    /// fetch perbarui status
                    fetch(`${window.location.origin}/transaksi/pay/status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: JSON.stringify({
                                result: result,
                                statusTransaksi: "paid"
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.error) {
                                window.location.href =
                                    `/transaksi?status=error`;
                            } else {
                                window.location.href = `/transaksi?status=success`;
                            }
                        })
                        .catch(error => {
                            console.log(error);
                            window.location.href =
                                `/transaksi?status=error`;
                        });
                },
                // Optional
                onPending: function(result) {
                    /// Redirect ke halaman kamu sendiri
                    window.location.href = `/transaksi?status=pending`;
                },
                // Optional
                onError: function(result) {
                    /// fetch perbarui status
                    fetch(`${window.location.origin}/transaksi/pay/status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: JSON.stringify({
                                result: result,
                                statusTransaksi: "failed"
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.error) {
                                window.location.href =
                                    `/transaksi?status=error`;
                            } else {
                                window.location.href = `/transaksi?status=failed`;
                            }
                        })
                        .catch(error => {
                            console.log(error);
                            window.location.href =
                                `/transaksi?status=error`;
                        });
                }
            });
        });
    });
</script>
<script>
    function confirmCancel(transactionId) {
        Swal.fire({
            title: 'Batalkan Transaksi?',
            text: 'Apakah Anda yakin ingin membatalkan transaksi ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('formCancel-' + transactionId);

                form.submit();
            }
        });
    }
</script>
