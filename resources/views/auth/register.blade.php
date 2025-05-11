@section('title-header', 'Sign Up')
@section('title', 'Sign Up')


<x-auth.layout>
    <!-- ====== Forms Section Start -->
    <div class="w-1/2 mx-auto p-4 sm:p-12.5 xl:p-17.5 bg-white rounded-xl">
        <span class="mb-1.5 block font-medium">Ayo bergabung dengan Cafe Hunt</span>
        <h2 class="flex items-center gap-1 text-2xl font-bold text-primary mb-9 sm:text-title-xl2">
            Sign Up
            <img src="{{ asset('images/logo-cafe-hunt.png') }}" alt="logo-cafe-hunt" class="h-16">
        </h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            {{-- role (hidden) --}}
            <input type="hidden" name="role" value="user">

            {{-- username --}}
            <div class="mb-4">
                <label class="mb-2.5 block font-medium text-black">Username</label>
                <div class="relative">
                    <input type="text" placeholder="Enter your username" name="username"
                        value="{{ old('username') }}"
                        class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none"
                        required />

                    <span class="absolute right-4 top-4">
                        <svg class="w-6 h-6 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2"
                                d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z" />
                        </svg>

                    </span>
                </div>

                @error('username')
                    <div class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="mb-2.5 block font-medium text-black">Email</label>
                <div class="relative">
                    <input type="email" placeholder="Enter your email" name="email" value="{{ old('email') }}"
                        class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none"
                        required />

                    <span class="absolute right-4 top-4">
                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.5">
                                <path
                                    d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z"
                                    fill="" />
                            </g>
                        </svg>
                    </span>
                </div>

                @error('email')
                    <div class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- No wa --}}
            <div class="mb-4">
                <label class="mb-2.5 block font-medium text-black">No Whatsapp</label>
                <div class="relative">
                    <input type="text" placeholder="08xxxxxxxx" minlength="10" maxlength="13" name="no_wa"
                        value="{{ old('no_wa') }}"
                        class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none"
                        required />

                    <span class="absolute right-4 top-4">
                        <svg class="w-6 h-6 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
                                clip-rule="evenodd" />
                            <path fill="currentColor"
                                d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                        </svg>

                    </span>
                </div>

                @error('no_wa')
                    <div class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div x-data="{ show: false }" class="mb-6">
                <label for="password" class="mb-2.5 block font-medium text-black">Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" placeholder="***********" name="password" id="password"
                        value="{{ old('password') }}"
                        class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none"
                        required />

                    <button type="button" class="absolute right-4 top-4 focus:outline-none" @click="show = !show">
                        <!-- Icon mata (lihat) -->
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Icon mata tertutup -->
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.091-3.362m3.411-2.413A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.963 9.963 0 01-1.507 2.472M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3L3 3m18 18l-3-3" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <div class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div x-data="{ show: false }" class="mb-6">
                <label for="confirm_password" class="mb-2.5 block font-medium text-black">Konfirmasi Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" placeholder="***********" name="confirm_password"
                        id="confirm_password" value="{{ old('confirm_password') }}"
                        class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none"
                        required />

                    <button type="button" class="absolute right-4 top-4 focus:outline-none" @click="show = !show">
                        <!-- Icon mata (lihat) -->
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Icon mata tertutup -->
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.091-3.362m3.411-2.413A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.963 9.963 0 01-1.507 2.472M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3L3 3m18 18l-3-3" />
                        </svg>
                    </button>
                </div>

                @error('confirm_password')
                    <div class="mt-1 text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-5">
                <input type="submit" value="Sign Up"
                    class="w-full p-4 font-medium text-white transition border rounded-lg cursor-pointer border-primary bg-primary hover:bg-opacity-90" />
            </div>


            <div class="mt-6 text-center">
                <p class="font-medium">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="text-primary">Sign In</a>
                </p>
            </div>
        </form>
    </div>
    <!-- ====== Forms Section End -->
</x-auth.layout>
