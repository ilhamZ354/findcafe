{{-- atas nama, nominal, catatan --}}

<x-modal.modal-template id_modal="booking-modal" title_modal="Booking Cafe">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="#">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Nama --}}
            <x-form.input-field name="name" value="{{ old('name') }}" label="Atas Nama"
                placeholder="Masukkan nama untuk booking" required />

            {{-- nominal --}}
            <x-form.input-field type="number" name="nominal" value="{{ old('nominal') }}" label="Nominal"
                placeholder="Nominal booking" min="0" required />

            {{-- Catatan --}}
            <x-form.input-field name="catatan" value="{{ old('catatan') }}" label="Catatan"
                placeholder="Masukkan catatan (opsional)" />
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
