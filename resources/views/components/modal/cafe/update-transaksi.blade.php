<x-modal.modal-template id_modal="update-transaksi" title_modal="Update Transaksi">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="{{ route('cafe.transaksi.updateTC', $transaction->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-2 mb-2">
            {{-- Nama Pemesan --}}
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Pemesan</label>
                <select name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    required>
                    @foreach ($users as $user)
                        <option value="{{ $user->name }}" {{ $transaction->name == $user->name ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Catatan --}}
            <x-form.input-field name="catatan" value="{{ $transaction->catatan }}" label="Catatan"
                placeholder="Catatan reservasi" />

            {{-- Nominal --}}
            <x-form.input-field name="nominal" type="number" value="{{ $transaction->nominal }}" label="Nominal"
                placeholder="Jumlah pembayaran" required />

            {{-- Tanggal Booking --}}
            <x-form.input-field name="tgl_booking" type="datetime-local"
                value="{{ \Carbon\Carbon::parse($transaction->tgl_booking)->format('Y-m-d\TH:i') }}"
                label="Tanggal & Waktu Booking" required />

            {{-- Status --}}
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status Transaksi</label>
                <select name="status" id="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    required>
                    <option value="unpaid" {{ $transaction->status == 'unpaid' ? 'selected' : '' }}>Belum Dibayar
                    </option>
                    <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Sudah Dibayar
                    </option>
                    <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Gagal</option>
                </select>
            </div>

            {{-- Snap Token --}}
            <x-form.input-field name="snap_token" value="{{ old('snap_token', $payment->snap_token ?? '') }}"
                label="Snap Token" placeholder="Token dari payment gateway" />

            {{-- Expired At --}}
            <x-form.input-field name="expired_at" type="datetime-local"
                value="{{ old('expired_at', isset($payment->expired_at) ? \Carbon\Carbon::parse($payment->expired_at)->format('Y-m-d\TH:i') : '') }}"
                label="Tanggal Expired" />

            {{-- Paid At --}}
            <x-form.input-field name="paid_at" type="datetime-local"
                value="{{ old('paid_at', isset($payment->paid_at) ? \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d\TH:i') : '') }}"
                label="Tanggal Pembayaran" />
        </div>

        {{-- Button Update --}}
        <x-form.button-form type="submit" label="Update">
            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </x-form.button-form>
    </form>
</x-modal.modal-template>
