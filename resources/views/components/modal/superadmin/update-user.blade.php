<x-modal.modal-template id_modal="update-user" title_modal="Update User">
    <!-- Modal body -->
    <form class="p-4 md:p-5" method="POST"
        action="{{ route('superadmin.user.update', isset($editUser) ? $editUser->id : '') }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- hidden id user --}}
            <input type="hidden" name="user_id" value="{{ isset($editUser) ? $editUser->id : '' }}">

            {{-- Nama Users --}}
            <x-form.input-field name="username" label="Nama Users" id="update-name" placeholder="Masukkan nama user"
                required value="{{ isset($editUser) ? $editUser->username : '' }}" />

            {{-- Email --}}
            <x-form.input-field name="email" type="email" label="Email" id="update-email"
                placeholder="Masukkan email" required value="{{ isset($editUser) ? $editUser->email : '' }}" />

            {{-- No WA --}}
            <x-form.input-field name="no_wa" label="No Whatsapp" minLength="10" id="update-no_wa"
                placeholder="08xxxxxxxx" required value="{{ isset($editUser) ? $editUser->no_wa : '' }}" />

            {{-- Role
            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                    <option value="user" {{ isset($editUser) && $editUser->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ isset($editUser) && $editUser->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ isset($editUser) && $editUser->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div> --}}

            {{-- Password --}}
            <x-form.input-field name="password" type="password" label="Password (Leave blank to keep current)"
                showTogglePassword="true" id="update-password" placeholder="**********" />
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
