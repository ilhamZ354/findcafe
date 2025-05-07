<x-modal.modal-template id_modal="add-transaksi" title_modal="Tambah Transaksi">
    <form class="p-4 md:p-5" method="POST" action="{{ route('superadmin.transaksi.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Pilih User --}}
            <div>
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih User</label>
                <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Cafe --}}
            <div>
                <label for="cafe_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Cafe</label>
                <select name="cafe_id" id="cafe_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                    <option value="">-- Pilih Cafe --</option>
                    @foreach($cafes as $cafe)
                        <option value="{{ $cafe->id }}">{{ $cafe->username }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Transaksi --}}
            <x-form.input-field name="name" label="Nama Transaksi" placeholder="Masukkan nama transaksi" required />

            {{-- Catatan --}}
            <x-form.input-field name="catatan" label="Catatan" placeholder="Masukkan catatan" />

            {{-- Nominal --}}
            <x-form.input-field name="nominal" type="number" label="Nominal" placeholder="Masukkan nominal" required />

            {{-- Tanggal Booking --}}
            <x-form.input-field name="tgl_booking" type="date" label="Tanggal Booking" required />

            {{-- Status --}}
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            {{-- Snap Token --}}
            <x-form.input-field name="snap_token" label="Snap Token" placeholder="Masukkan snap token" />
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