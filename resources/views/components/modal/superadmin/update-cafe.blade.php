<x-modal.modal-template id_modal="update-cafe" title_modal="Update Cafe">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST"
        action="{{ route('superadmin.cafe.update', isset($editCafe) ? $editCafe->id : '') }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Nama Cafe --}}
            <x-form.input-field name="username" label="Nama Cafe" value="{{ isset($editCafe) ? $editCafe->username : '' }}"
                placeholder="Masukkan nama cafe" required />

            {{-- Email --}}
            <x-form.input-field name="email" type="email" label="Email"
                value="{{ isset($editCafe) ? $editCafe->email : '' }}" placeholder="Masukkan email" required />

            {{-- No WA --}}
            <x-form.input-field name="no_wa" label="No Whatsapp"
                value="{{ isset($editCafe) ? $editCafe->no_wa : '' }}" placeholder="Masukkan nomor WhatsApp" required />

            {{-- Password --}}
            <x-form.input-field name="password" type="password" label="Password (Kosongkan jika tidak diubah)"
                showTogglePassword="true" placeholder="**********" />
        </div>

        {{-- Button Simpan --}}
        <x-form.button-form type="submit" label="Update">
            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </x-form.button-form>
    </form>
</x-modal.modal-template>
