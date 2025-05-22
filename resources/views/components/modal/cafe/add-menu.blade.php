<x-modal.modal-template id_modal="add-menu" title_modal="Tambah Menu">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="{{ route('cafe.menu.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">

            {{-- Nama Menu --}}
            <x-form.input-field name="name" value="{{ old('name') }}" label="Nama Menu"
                placeholder="Masukkan nama menu" required />

            {{-- Deskripsi --}}
            <x-form.input-field name="description" value="{{ old('description') }}" label="Deskripsi"
                placeholder="Deskripsi menu (opsional)" />

            {{-- Gambar --}}
            <x-form.menu-image value="{{ old('image') }}"/>

            {{-- Tipe --}}
            <x-form.select-field name="type" label="Tipe Menu" required :options="[
                'makanan' => 'Makanan',
                'minuman' => 'Minuman',
            ]" />

            {{-- Harga --}}
            <x-form.input-field name="harga" type="text" value="{{ old('harga') }}" label="Harga"
                placeholder="Masukkan harga menu" required />
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
