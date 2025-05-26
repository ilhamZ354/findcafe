
{{-- modal form tambah akun cafe --}}
<x-modal.modal-template id_modal="add-cafe" title_modal="Tambah Cafe">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="{{ route('superadmin.cafe.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Role(hidden) --}}
            <input type="hidden" name="role" value="cafe">

            {{-- username Cafe --}}
            <x-form.input-field name="username" value="{{ $username ?? '' }}" label="Username Cafe"
                placeholder="Masukkan username cafe" required />

            {{-- Nama Cafe --}}
            <x-form.input-field name="name" value="{{ $name ?? '' }}" label="Nama Cafe"
                placeholder="Masukkan nama cafe" required />

            {{-- Email --}}
            <x-form.input-field name="email" type="email" value="{{ $email ?? '' }}" label="Email"
                placeholder="Masukkan email" required />

            {{-- No WA --}}
            <x-form.input-field name="no_wa" value="{{ $no_wa ?? '' }}" label="No Whatsapp" minLength="10"
                placeholder="08xxxxxxxx" required maxlength="13" />

            {{-- Password --}}
            <x-form.input-field name="password" type="password" label="Password" showTogglePassword="true"
                value="{{ $password ?? '' }}" placeholder="**********" required />

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
