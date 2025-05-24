<x-modal.modal-template id_modal="update-menu" title_modal="Update Menu">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="{{ route('cafe.menu.update', $menu->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Nama Menu --}}
            <x-form.input-field name="name" value="{{ $menu->name }}" label="Nama Menu"
                placeholder="Masukkan nama menu" required />

            {{-- Deskripsi --}}
            <x-form.input-field name="description" value="{{ $menu->description }}" label="Deskripsi"
                placeholder="Deskripsi menu" required />

            {{-- Gambar --}}
            <x-form.input-field name="image" type="file" label="Ganti Gambar (kosongkan jika tidak diubah)"
                accept="image/*" />

            {{-- Tipe --}}
            <x-form.select-field name="type" label="Tipe Menu" required :options="[
                'makanan' => 'Makanan',
                'minuman' => 'Minuman',
            ]"
                value="{{ $menu->type }}" />

            {{-- Harga --}}
            <x-form.input-field name="price" type="number" value="{{ $menu->harga }}" label="Harga"
                placeholder="Masukkan harga menu" required />
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
