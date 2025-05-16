<x-modal.modal-template id_modal="add-transaksi" title_modal="Tambah Transaksi">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="{{ route('cafe.transaksi.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-2 mb-2">
            {{-- ID Cafe (hidden) --}}
            <input type="hidden" name="cafe_id" value="{{ Auth::id() }}">

            {{-- Nama User --}}
            <x-form.select-field name="user_id" label="Nama Pelanggan" required :options="$users->pluck('name', 'id')->toArray()" :selected="old('user_id')" />

            {{-- Catatan --}}
            <x-form.input-field name="catatan" value="{{ old('catatan') }}" label="Catatan"
                placeholder="Catatan reservasi (opsional)" />

            {{-- Nominal --}}
            <x-form.input-field name="nominal" type="number" value="{{ old('nominal') }}" label="Nominal"
                placeholder="Jumlah pembayaran" required />

            {{-- Tanggal Booking --}}
            <x-form.input-field name="tgl_booking" type="datetime-local"
                value="{{ old('tgl_booking') ?? \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                label="Tanggal & Waktu Booking" required />

            {{-- Status --}}
            <x-form.select-field name="status" label="Status Transaksi" required :options="[
                'unpaid' => 'Belum Dibayar',
                'paid' => 'Sudah Dibayar',
                'failed' => 'Gagal',
            ]" :selected="old('status') ?? 'unpaid'" />

            {{-- Snap Token --}}
            <x-form.input-field name="snap_token" value="{{ old('snap_token') }}" label="Snap Token"
                placeholder="Token dari payment gateway" />

            {{-- Expired At --}}
            <x-form.input-field name="expired_at" type="datetime-local"
                value="{{ old('expired_at') ?? \Carbon\Carbon::now()->addDay()->format('Y-m-d\TH:i') }}"
                label="Tanggal Expired" />

            {{-- Paid At --}}
            <x-form.input-field name="paid_at" type="datetime-local" v
                value="{{ old('paid_at') ?? \Carbon\Carbon::now()->addDay()->format('Y-m-d\TH:i') }}"
                label="Tanggal Pembayaran" />
        </div>

        {{-- Button Simpan --}}
        <x-form.button-form type="submit" label="Simpan">
            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </x-form.button-form>
    </form>
</x-modal.modal-template>
