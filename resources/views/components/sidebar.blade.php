<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute top-0 left-0 flex flex-col h-screen overflow-y-hidden duration-300 ease-linear bg-semiPrimary w-60 z-9999 dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    <div style="background: linear-gradient(to bottom, #DDBC95, #B38867);"
        class="bg-black flex flex-col overflow-y-auto min-h-screen duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav class="px-2 py-2 mt-2 lg:mt-3 lg:px-3" x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>
                <ul class="mb-4 flex flex-col gap-1">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a class="flex justify-center items-center p-4 hover:bg-gray rounded-xl" href="/dashboard"
                            @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                            :class="{
                                'bg-lightPrimary text-primaryBrown': (selected === 'Dashboard') || (
                                    page === 'ecommerce' || page === 'analytics' || page === 'stocks')
                            }">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="#764425"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 9.75L12 3L21 9.75V20C21 20.4142 20.6642 20.75 20.25 20.75H15.75C15.3358 20.75 15 20.4142 15 20V15.75C15 15.3358 14.6642 15 14.25 15H9.75C9.33579 15 9 15.3358 9 15.75V20C9 20.4142 8.66421 20.75 8.25 20.75H3.75C3.33579 20.75 3 20.4142 3 20V9.75Z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->

                    <!-- Menu Item Bookmark -->
                    <li>
                        <a class="flex justify-center items-center p-4 hover:bg-gray rounded-xl" href="/bookmark"
                            @click="selected = (selected === 'Bookmark' ? '':'Bookmark')"
                            :class="{
                                'bg-lightPrimary text-primaryBrown': (selected === 'Bookmark') || (
                                    page === 'boomark')
                            }">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="#764425"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 2C4.9 2 4 2.9 4 4V21.5C4 21.78 4.22 22 4.5 22C4.67 22 4.83 21.93 4.94 21.81L12 15.36L19.06 21.81C19.17 21.93 19.33 22 19.5 22C19.78 22 20 21.78 20 21.5V4C20 2.9 19.1 2 18 2H6Z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Menu Item Bookmark -->

                    <!-- Menu Item Cafe -->
                    <li>
                        <a class="flex justify-center items-center p-4 hover:bg-gray rounded-xl" href="/cafe"
                            @click="selected = (selected === 'Cafe' ? '':'Cafe')"
                            :class="{
                                'bg-lightPrimary text-primaryBrown': (selected === 'Cafe') || (
                                    page === 'cafe')
                            }">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="#764425"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9V7l1-4h16l1 4v2l-1 10h-16L3 9zm2 0h14v8h-14V9zm3-2h8v-2h-8v2z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Menu Item Cafe -->

                    <!-- Menu Item Menu Cafe -->
                    <li>
                        <a class="flex justify-center items-center p-4 hover:bg-gray rounded-xl" href="/menu-cafe"
                            @click="selected = (selected === 'Menu Cafe' ? '':'Menu Cafe')"
                            :class="{
                                'bg-lightPrimary text-primaryBrown': (selected === 'Menu Cafe') || (
                                    page === 'menu-cafe')
                            }">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="#764425"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 12h20a10 10 0 01-20 0zm2-4h16v2H4v-2zm4-4h8v2H8V4z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Menu Item Menu Cafe -->

                    <!-- Menu Item Users -->
                    <li>
                        <a class="flex justify-center items-center p-4 hover:bg-gray rounded-xl" href="/users"
                            @click="selected = (selected === 'Users' ? '':'Users')"
                            :class="{
                                'bg-lightPrimary text-primaryBrown': (selected === 'Users') || (
                                    page === 'users')
                            }">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="#764425"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Menu Item Users -->
                </ul>
            </div>

        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
