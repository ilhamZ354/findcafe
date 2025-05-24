@section('title-header', 'Sign In')
@section('title', 'Sign In')

<x-auth.layout>
    <!-- ====== Forms Section Start -->
    <div class="w-[90%] md:w-1/2 mx-auto p-4 sm:p-12.5 xl:p-17.5 bg-white rounded-xl">
        <span class="mb-1.5 block font-medium">Mari mulai petualangan baru dengan Cafe Hunt</span>
        <h2 class="flex items-center gap-1 text-2xl font-bold text-primary mb-9 sm:text-title-xl2">
            Sign In
            <img src="{{ asset('images/logo-cafe-hunt.png') }}" alt="logo-cafe-hunt" class="h-16">
        </h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="mb-2.5 block font-medium text-black">Email</label>
                <div class="relative">
                    <input type="email" name="email" placeholder="Enter your email"
                        class="w-full py-4 pl-6 pr-10 bg-white border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none"
                        autocomplete="off" />

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
            </div>

            <div x-data="{ show: false }" class="mb-6">
                <label class="mb-2.5 block font-medium text-black">Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" placeholder="***********" name="password"
                        class="w-full py-4 pl-6 pr-10 bg-transparent border rounded-lg outline-none border-stroke focus:border-primary focus-visible:shadow-none" />

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
            </div>

            <div class="mb-5">
                <input type="submit" value="Sign In"
                    class="w-full p-4 font-medium text-white transition border rounded-lg cursor-pointer border-primary bg-primary hover:bg-opacity-90" />
            </div>


            <div class="mt-6 text-center">
                <p class="font-medium">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}" class="text-primary">Sign Up</a>
                </p>
            </div>
        </form>
    </div>
    <!-- ====== Forms Section End -->
</x-auth.layout>
