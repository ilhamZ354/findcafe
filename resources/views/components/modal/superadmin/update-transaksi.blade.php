<x-modal.modal-template id_modal="update-transaksi" title_modal="Update Transaksi">
    <form class="p-4 md:p-5" method="POST"
        action="{{ route('superadmin.transaksi.update', isset($transaction) ? $transaction->id : '') }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Hidden ID Transaksi --}}
            <input type="hidden" name="transaction_id" value="{{ isset($transaction) ? $transaction->id : '' }}">

            {{-- Pilih User --}}
            <div>
                <label for="update-user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    User</label>
                <select name="user_id" id="update-user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                    required>
                    <option value="">-- Pilih User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ isset($transaction) && $transaction->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Cafe --}}
            <div>
                <label for="update-cafe_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Cafe</label>
                <select name="cafe_id" id="update-cafe_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                    required>
                    <option value="">-- Pilih Cafe --</option>
                    @foreach ($cafes as $cafe)
                        <option value="{{ $cafe->id }}"
                            {{ isset($transaction) && $transaction->cafe_id == $cafe->id ? 'selected' : '' }}>
                            {{ $cafe->username }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Transaksi --}}
            <x-form.input-field name="name" label="Nama Transaksi" id="update-name"
                placeholder="Masukkan nama transaksi" required
                value="{{ isset($transaction) ? $transaction->name : '' }}" />

            {{-- Catatan --}}
            <x-form.input-field name="catatan" label="Catatan" id="update-catatan" placeholder="Masukkan catatan"
                value="{{ isset($transaction) ? $transaction->catatan : '' }}" />

            {{-- Nominal --}}
            <x-form.input-field name="nominal" type="number" label="Nominal" id="update-nominal"
                placeholder="Masukkan nominal" required
                value="{{ isset($transaction) ? $transaction->nominal : '' }}" />

            {{-- Tanggal Booking --}}
            <x-form.input-field name="tgl_booking" type="date" label="Tanggal Booking" id="update-tgl_booking"
                required value="{{ isset($transaction) ? $transaction->tgl_booking : '' }}" />

            {{-- Status --}}
            <div>
                <label for="update-status"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="update-status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                    required>
                    <option value="pending"
                        {{ isset($transaction) && $transaction->status == 'pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="confirmed"
                        {{ isset($transaction) && $transaction->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                    </option>
                    <option value="cancelled"
                        {{ isset($transaction) && $transaction->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>
            </div>

            {{-- Snap Token --}}
            <x-form.input-field name="snap_token" label="Snap Token" id="update-snap_token"
                placeholder="Masukkan snap token" value="{{ isset($transaction) ? $transaction->snap_token : '' }}" />
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
