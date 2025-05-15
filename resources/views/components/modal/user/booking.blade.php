{{-- atas nama, nominal, catatan --}}

<x-modal.modal-template id_modal="booking-modal" title_modal="Booking Cafe">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="{{  route('store-transaksi', $cafe_id)}}">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Nama --}}
            <x-form.input-field name="name" value="{{ old('name') }}" label="Atas Nama"
                placeholder="Masukkan nama untuk booking" required />

            {{-- nominal --}}
            <x-form.input-field type="text" name="nominal_display" label="Nominal" placeholder="Nominal booking"
                min="0" required />

            <input type="hidden" name="nominal" id="nominal">

            {{-- Catatan --}}
            <x-form.input-field name="catatan" value="{{ old('catatan') }}" label="Catatan"
                placeholder="Masukkan catatan (opsional)" />
        </div>

        {{-- Button Simpan --}}
        <button type="submit"
            class="text-white inline-flex items-center bg-primaryBrown hover:bg-opacity-80 focus:ring-1 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Simpan
        </button>
    </form>
</x-modal.modal-template>

<script>
    const price = document.getElementById('nominal');
    const priceDisplay = document.getElementById('nominal_display');

    priceDisplay.addEventListener('input', function() {
        // Ambil angka murni dari input (hapus semua kecuali digit)
        const raw = priceDisplay.value.replace(/\D/g, "");
        const priceInt = parseInt(raw) || 0;

        // Format dengan prefix "Rp " dan pemisah ribuan
        priceDisplay.value = "Rp " + priceInt.toLocaleString("id-ID");

        // Simpan nilai bersih ke input hidden
        price.value = priceInt;
    });
</script>
