<x-modal.modal-template id_modal="update-trace-user" title_modal="Update User">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST" action="">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- hidden id user --}}
            <input type="hidden" name="id" id="update-id" value="">

            {{-- Role(hidden) --}}
            <input type="hidden" name="role" value="user">

            {{-- Nama Users --}}
            <x-form.input-field name="username" label="Nama Users" id="update-name"
                placeholder="Masukkan nama user" required />

            {{-- Email --}}
            <x-form.input-field name="email" type="email" label="Email" id="update-email"
                placeholder="Masukkan email" required />

            {{-- No WA --}}
            <x-form.input-field name="no_wa" label="No Whatsapp" minLength="10" id="update-no_wa"
            placeholder="08xxxxxxxx" required />

            {{-- Password --}}
            <x-form.input-field name="password" type="password" label="Password" showTogglePassword="true" id="update-password"
                placeholder="**********" required />

            {{-- Konfirmasi Password --}}
            {{-- <x-form.input-field name="confirm_password" type="password" label="Konfirmasi Password"
                showTogglePassword="true" placeholder="**********" required /> --}}
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
