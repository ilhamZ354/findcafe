<!-- ===== Header Start ===== -->
<header class="sticky top-0 z-30 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">
    <div class="flex items-center justify-between flex-grow px-4 py-4 shadow-2 md:px-6 2xl:px-11">
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button
                class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:bg-boxdark lg:hidden"
                @click.stop="sidebarToggle = !sidebarToggle">
                <span class="relative block h-5.5 w-5.5 cursor-pointer">
                    <span class="absolute right-0 w-full h-full du-block">
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                            :class="{ '!w-full delay-300': !sidebarToggle }"></span>
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white"
                            :class="{ '!w-full delay-400': !sidebarToggle }"></span>
                        <span
                            class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white"
                            :class="{ '!w-full delay-500': !sidebarToggle }"></span>
                    </span>
                    <span class="absolute right-0 w-full h-full rotate-45 du-block">
                        <span
                            class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white"
                            :class="{ '!h-0 delay-[0]': !sidebarToggle }"></span>
                        <span
                            class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white"
                            :class="{ '!h-0 dealy-200': !sidebarToggle }"></span>
                    </span>
                </span>
            </button>
            <!-- Hamburger Toggle BTN -->
            <a class="flex-shrink-0 block lg:hidden" href="{{ asset('tailadmin/build/index.html') }}">
                <img src="{{ asset('images/logo-cafe-hunt.png') }}" alt="Logo" loading="lazy" class="h-8" />
            </a>
        </div>
        <div class="hidden sm:block">
            <form action="https://formbold.com/s/unique_form_id" method="POST">
                <div class="relative">
                    <button class="absolute left-0 -translate-y-1/2 top-1/2">
                        <svg class="fill-body hover:fill-primary dark:fill-bodydark dark:hover:fill-primary"
                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.16666 3.33332C5.945 3.33332 3.33332 5.945 3.33332 9.16666C3.33332 12.3883 5.945 15 9.16666 15C12.3883 15 15 12.3883 15 9.16666C15 5.945 12.3883 3.33332 9.16666 3.33332ZM1.66666 9.16666C1.66666 5.02452 5.02452 1.66666 9.16666 1.66666C13.3088 1.66666 16.6667 5.02452 16.6667 9.16666C16.6667 13.3088 13.3088 16.6667 9.16666 16.6667C5.02452 16.6667 1.66666 13.3088 1.66666 9.16666Z"
                                fill="" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.2857 13.2857C13.6112 12.9603 14.1388 12.9603 14.4642 13.2857L18.0892 16.9107C18.4147 17.2362 18.4147 17.7638 18.0892 18.0892C17.7638 18.4147 17.2362 18.4147 16.9107 18.0892L13.2857 14.4642C12.9603 14.1388 12.9603 13.6112 13.2857 13.2857Z"
                                fill="" />
                        </svg>
                    </button>

                    <input type="text" placeholder="Type to search..."
                        class="w-full pr-4 bg-transparent pl-9 focus:outline-none xl:w-125" />
                </div>
            </form>
        </div>

        <div class="flex items-center gap-3 2xsm:gap-7">
            <ul class="flex items-center gap-2 2xsm:gap-4">
                <!-- Chat Notification Area -->
                <li class="relative" x-data="{ dropdownOpen: false, notifying: true }" @click.outside="dropdownOpen = false">
                    <a class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border-[0.5px] border-stroke bg-gray hover:text-primary"
                        href="#" @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false">
                        <span :class="!notifying && 'hidden'"
                            class="absolute -right-0.5 -top-0.5 z-1 h-2 w-2 rounded-full bg-meta-1">
                            <span
                                class="absolute inline-flex w-full h-full rounded-full opacity-75 -z-1 animate-ping bg-meta-1"></span>
                        </span>

                        <svg class="duration-300 ease-in-out fill-current" width="18" height="18"
                            viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.9688 1.57495H7.03135C3.43135 1.57495 0.506348 4.41558 0.506348 7.90308C0.506348 11.3906 2.75635 13.8375 8.26885 16.3125C8.40947 16.3687 8.52197 16.3968 8.6626 16.3968C8.85947 16.3968 9.02822 16.3406 9.19697 16.2281C9.47822 16.0593 9.64697 15.75 9.64697 15.4125V14.2031H10.9688C14.5688 14.2031 17.522 11.3625 17.522 7.87495C17.522 4.38745 14.5688 1.57495 10.9688 1.57495ZM10.9688 12.9937H9.3376C8.80322 12.9937 8.35322 13.4437 8.35322 13.9781V15.0187C3.6001 12.825 1.74385 10.8 1.74385 7.9312C1.74385 5.14683 4.10635 2.8687 7.03135 2.8687H10.9688C13.8657 2.8687 16.2563 5.14683 16.2563 7.9312C16.2563 10.7156 13.8657 12.9937 10.9688 12.9937Z"
                                fill="" />
                            <path
                                d="M5.42812 7.28442C5.0625 7.28442 4.78125 7.56567 4.78125 7.9313C4.78125 8.29692 5.0625 8.57817 5.42812 8.57817C5.79375 8.57817 6.075 8.29692 6.075 7.9313C6.075 7.56567 5.79375 7.28442 5.42812 7.28442Z"
                                fill="" />
                            <path
                                d="M9.00015 7.28442C8.63452 7.28442 8.35327 7.56567 8.35327 7.9313C8.35327 8.29692 8.63452 8.57817 9.00015 8.57817C9.33765 8.57817 9.64702 8.29692 9.64702 7.9313C9.64702 7.56567 9.33765 7.28442 9.00015 7.28442Z"
                                fill="" />
                            <path
                                d="M12.5719 7.28442C12.2063 7.28442 11.925 7.56567 11.925 7.9313C11.925 8.29692 12.2063 8.57817 12.5719 8.57817C12.9375 8.57817 13.2188 8.29692 13.2188 7.9313C13.2188 7.56567 12.9094 7.28442 12.5719 7.28442Z"
                                fill="" />
                        </svg>
                    </a>

                    <!-- Dropdown Start -->
                    <div x-show="dropdownOpen"
                        class="absolute -right-16 mt-2.5 flex h-90 w-75 flex-col rounded-sm border border-stroke bg-white shadow-default dark:bg-boxdark sm:right-0 sm:w-80">
                        <div class="px-4.5 py-3">
                            <h5 class="text-sm font-medium text-bodydark2">Messages</h5>
                        </div>

                        <ul class="flex flex-col h-auto overflow-y-auto">
                            <li>
                                <a class="flex gap-4.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:hover:bg-meta-4"
                                    href="{{ asset('tailadmin/build/messages.html') }}">
                                    <div class="h-12.5 w-12.5 rounded-full">
                                        <img src="{{ asset('tailadmin/build/src/images/user/user-02.png') }}"
                                            alt="User" />
                                    </div>

                                    <div>
                                        <h6 class="text-sm font-medium text-black dark:text-white">
                                            Mariya Desoja
                                        </h6>
                                        <p class="text-sm">I like your confidence 💪</p>
                                        <p class="text-xs">2min ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="flex gap-4.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:hover:bg-meta-4"
                                    href="{{ asset('tailadmin/build/messages.html') }}">
                                    <div class="h-12.5 w-12.5 rounded-full">
                                        <img src="{{ asset('tailadmin/build/src/images/user/user-01.png') }}"
                                            alt="User" />
                                    </div>

                                    <div>
                                        <h6 class="text-sm font-medium text-black dark:text-white">
                                            Robert Jhon
                                        </h6>
                                        <p class="text-sm">Can you share your offer?</p>
                                        <p class="text-xs">10min ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="flex gap-4.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:hover:bg-meta-4"
                                    href="{{ asset('tailadmin/build/messages.html') }}">
                                    <div class="h-12.5 w-12.5 rounded-full">
                                        <img src="{{ asset('tailadmin/build/src/images/user/user-03.png') }}"
                                            alt="User" />
                                    </div>

                                    <div>
                                        <h6 class="text-sm font-medium text-black dark:text-white">
                                            Henry Dholi
                                        </h6>
                                        <p class="text-sm">I cam across your profile and...</p>
                                        <p class="text-xs">1day ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="flex gap-4.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:hover:bg-meta-4"
                                    href="{{ asset('tailadmin/build/messages.html') }}">
                                    <div class="h-12.5 w-12.5 rounded-full">
                                        <img src="{{ asset('tailadmin/build/src/images/user/user-04.png') }}"
                                            alt="User" />
                                    </div>

                                    <div>
                                        <h6 class="text-sm font-medium text-black dark:text-white">
                                            Cody Fisher
                                        </h6>
                                        <p class="text-sm">I’m waiting for you response!</p>
                                        <p class="text-xs">5days ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="flex gap-4.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:hover:bg-meta-4"
                                    href="{{ asset('tailadmin/build/messages.html') }}">
                                    <div class="h-12.5 w-12.5 rounded-full">
                                        <img src="{{ asset('tailadmin/build/src/images/user/user-02.png') }}"
                                            alt="User" />
                                    </div>

                                    <div>
                                        <h6 class="text-sm font-medium text-black dark:text-white">
                                            Mariya Desoja
                                        </h6>
                                        <p class="text-sm">I like your confidence 💪</p>
                                        <p class="text-xs">2min ago</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Dropdown End -->
                </li>
                <!-- Chat Notification Area -->
            </ul>

            <!-- User Area -->
            <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                <a class="flex items-center gap-4" href="{{ route('dashboard') }}"
                    @click.prevent="dropdownOpen = ! dropdownOpen">

                    {{-- Detail User --}}
                    <span class="hidden text-right lg:block">
                        <span
                            class="block text-sm font-medium text-black capitalize">{{ auth()->user()->username ?? 'Anonim' }}</span>
                        <span class="block text-xs font-medium">{{ auth()->user()->role ?? '' }}</span>
                    </span>

                    <span class="w-12 h-12 rounded-full">
                        <img src="{{ asset('tailadmin/build/src/images/user/user-01.png') }}" alt="User" />
                    </span>

                    <svg :class="dropdownOpen && 'rotate-180'" class="hidden fill-current sm:block" width="12"
                        height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"
                            fill="" />
                    </svg>
                </a>

                <!-- Dropdown Start -->
                <div x-show="dropdownOpen"
                    class="absolute right-0 flex flex-col mt-5 bg-white border rounded-xl w-52 border-stroke shadow-default dark:bg-boxdark">
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
                            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <!-- Dropdown End -->
            </div>
            <!-- User Area -->
        </div>
    </div>
</header>
<!-- ===== Header End ===== -->

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
</script>
