@section('title-header', 'Detail Transaksi')
@section('title', 'Detail Transaksi')

<x-auth.layout>
    <!-- ====== Forms Section Start -->
    <div class="w-[90%] md:w-1/2 mx-auto p-4 sm:p-12.5 xl:p-17.5 bg-white rounded-xl mt-20">
        <h2 class="flex items-center gap-1 text-2xl font-bold text-primary mb-9 sm:text-title-xl2">
            Detail Transaksi
            <img src="{{ asset('images/logo-cafe-hunt.png') }}" alt="logo-cafe-hunt" class="h-16">
        </h2>

        <table class="w-full table-fixed border-separate border-spacing-y-1">
            <tbody class="space-y-20">
                <tr>
                    <td class="w-1/3 text-sm text-gray-500">Atas Nama</td>
                    <td class="text-sm font-semibold text-gray-900">{{ $transaction->name }}</td>
                </tr>
                <tr class="mt-10">
                    <td class="w-1/3 text-sm text-gray-500">Cafe</td>
                    <td class="text-sm font-semibold text-gray-900">{{ $transaction->cafe->name }}</td>
                </tr>
                <tr class="mt-5">
                    <td class="text-sm text-gray-500">Tanggal Booking</td>
                    <td class="text-sm font-semibold text-gray-900">
                        {{ $transaction->tgl_booking ? $transaction->tgl_booking->format('d F Y H:i') : '-' }}</td>
                </tr>
                <tr class="mt-5">
                    <td class="w-1/3 text-sm text-gray-500">Nominal Booking</td>
                    <td class="text-sm font-semibold text-gray-900">
                        Rp {{ number_format($transaction->nominal, 0, ',', '.') }}</td>
                </tr>
                <tr class="mt-5">
                    <td class="w-1/3 text-sm text-gray-500">Catatan</td>
                    <td class="text-sm font-semibold text-gray-900">
                        {{ $transaction->catatan ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>

        <span
            class=" {{ $transaction->status === 'paid' ? 'text-green-800 bg-green-100' : 'text-yellow-800 bg-yellow-100' }} text-sm font-medium me-2 px-10 py-1.5 rounded-sm mx-auto block text-center mt-5 w-fit uppercase">{{ $transaction->status }}</span>

        <div class="mt-10 mx-auto flex gap-5">
            @if ($transaction->status == 'unpaid')
                {{-- pay button --}}
                <button type="button" data-snap-token="{{ $transaction->payments->snap_token }}"
                    class="pay-button text-primaryBrown hover:text-white border border-primaryBrown hover:bg-primaryBrown focus:ring-4 focus:outline-none focus:ring-semiPrimaryBrown font-medium rounded-lg text-sm px-4 py-1.5 text-center me-2 mb-2 bg-lightPrimaryBrown/50 backdrop-blur-xl w-full">Bayar
                    Sekarang</button>
            @endif

            <a href="{{ route('transaksi-user') }}"
                class="text-gray-500 border border-gray-700
             focus:ring-4 focus:outline-none focus:ring-semigray-500 font-medium rounded-lg
                text-sm px-4 py-1.5 text-center me-2 mb-2 bg-gray-100/50 backdrop-blur-xl w-full">
                Ke Halaman Riwayat
            </a>
        </div>
    </div>
    <!-- ====== Forms Section End -->
</x-auth.layout>


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
