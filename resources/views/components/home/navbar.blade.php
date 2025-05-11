<nav class="fixed top-0 z-40 w-screen border-b border-gray-200 bg-lightPrimaryBrown">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo-cafe-hunt.png') }}" class="h-10" alt="Cafe Hunt Logo">
        </a>
        <div class="flex space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">
            {{-- <button type="button"
                class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-primaryBrown hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Mulai Menjelajah
            </button> --}}

            <div>
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                    class="flex items-center justify-between w-full px-3 py-2 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primaryBrown md:p-0 md:w-auto">
                    {{-- person --}}
                    <img src="{{ asset('images/profile-default.png') }}" alt="profile" class="w-10 h-10 rounded-full">

                    {{-- under --}}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg></button>
                <!-- Dropdown menu -->
                <div id="dropdownNavbar"
                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                    <ul class="flex flex-col gap-5 px-6 py-4 border-b border-stroke">
                        <li>
                            <a href="{{ asset('tailadmin/build/profile.html') }}"
                                class="flex items-center gap-1 text-xs font-medium duration-300 ease-in-out text-primary lg:text-base">
                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"
                                        fill="" />
                                    <path
                                        d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.10935 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"
                                        fill="" />
                                </svg>
                                My Profile
                            </a>
                        </li>
                    </ul>
                    <form id="formLogout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" onclick="logout()"
                            class="flex items-center gap-1 px-6 py-4 text-sm font-medium text-red-500 duration-300 ease-in-out lg:text-base">
                            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.5375 0.618744H11.6531C10.7594 0.618744 10.0031 1.37499 10.0031 2.26874V4.64062C10.0031 5.05312 10.3469 5.39687 10.7594 5.39687C11.1719 5.39687 11.55 5.05312 11.55 4.64062V2.23437C11.55 2.16562 11.5844 2.13124 11.6531 2.13124H15.5375C16.3625 2.13124 17.0156 2.78437 17.0156 3.60937V18.3562C17.0156 19.1812 16.3625 19.8344 15.5375 19.8344H11.6531C11.5844 19.8344 11.55 19.8 11.55 19.7312V17.3594C11.55 16.9469 11.2062 16.6031 10.7594 16.6031C10.3125 16.6031 10.0031 16.9469 10.0031 17.3594V19.7312C10.0031 20.625 10.7594 21.3812 11.6531 21.3812H15.5375C17.2219 21.3812 18.5625 20.0062 18.5625 18.3562V3.64374C18.5625 1.95937 17.1875 0.618744 15.5375 0.618744Z"
                                    fill="" />
                                <path
                                    d="M6.05001 11.7563H12.2031C12.6156 11.7563 12.9594 11.4125 12.9594 11C12.9594 10.5875 12.6156 10.2438 12.2031 10.2438H6.08439L8.21564 8.07813C8.52501 7.76875 8.52501 7.2875 8.21564 6.97812C7.90626 6.66875 7.42501 6.66875 7.11564 6.97812L3.67814 10.4844C3.36876 10.7938 3.36876 11.275 3.67814 11.5844L7.11564 15.0906C7.25314 15.2281 7.45939 15.3312 7.66564 15.3312C7.87189 15.3312 8.04376 15.2625 8.21564 15.125C8.52501 14.8156 8.52501 14.3344 8.21564 14.025L6.05001 11.7563Z"
                                    fill="" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="#"
                        class="block px-3 py-2 text-white rounded bg-primaryBrown md:bg-transparent md:text-primaryBrown md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#about"
                        class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primaryBrown md:p-0">Tentang</a>
                </li>
                <li>
                    <a href="#services"
                        class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primaryBrown md:p-0">Layanan</a>
                </li>
                <li>
                    <a href="#contact"
                        class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primaryBrown md:p-0">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function logout() {
        Swal.fire({
            title: 'Apakah kamu yakin ingin Logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik "Hapus", kirim form-nya
                document.getElementById('formLogout').submit();
            }
        });
    }


    document.addEventListener("DOMContentLoaded", () => {
        const navLinks = document.querySelectorAll("#navbar-sticky ul li a");

        navLinks.forEach(link => {
            link.addEventListener("click", function(e) {
                // Reset semua link ke state non-aktif
                navLinks.forEach(l => {
                    l.classList.remove("text-white", "bg-primaryBrown",
                        "md:text-primaryBrown", "md:bg-transparent");
                    l.classList.add("text-gray-900", "hover:bg-gray-100",
                        "md:hover:bg-transparent", "md:hover:text-primaryBrown");
                });

                // Aktifkan link yang diklik
                this.classList.remove("text-gray-900", "hover:bg-gray-100",
                    "md:hover:bg-transparent", "md:hover:text-primaryBrown");
                this.classList.add("text-white", "bg-primaryBrown", "md:text-primaryBrown",
                    "md:bg-transparent");
            });
        });
    });
</script>
