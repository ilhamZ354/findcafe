<x-home.layout title="Profile">
    <div class="min-h-[55vh] px-5 my-20 md:px-10">
        <div class="flex items-center justify-start w-full gap-2">
            {{-- button back --}}
            <x-button.back-pages href="http://localhost:8000/home"></x-button.back-pages>

            <h3 class="text-xl tracking-wide text-primaryBrown">Profile</h3>
        </div>

        <div>
            <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
                <div class="mx-auto">

                    <!-- ====== Profile Section -->
                    <div class="overflow-hidden bg-white border rounded-xl border-stroke shadow-default">
                        <div class="relative z-20 h-35 md:h-65">
                            <img src="{{ asset('images/carousel/gambar-1.png') }}" alt="profile cover"
                                class="object-cover object-center w-full rounded-tl-sm rounded-tr-sm h-72" />
                        </div>
                        <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
                            <div
                                class="relative z-30 w-full p-1 mx-auto rounded-full -mt-[6.5rem] h-30 max-w-30 bg-white/20 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3">
                                <div class="relative drop-shadow-2">
                                    <img src="{{ asset('images/profile-default.png') }}" alt="profile" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-2xl font-medium text-black capitalize">
                                    {{ Auth::user()->name }}
                                </h3>
                                <span
                                    class="mb-4 text-xs italic font-light text-grayTheme">{{ Auth::user()->username }}</span>
                                <p class="text-xl font-medium">{{ Auth::user()->email }}</p>
                                <span class="text-lg font-light text-grayTheme">Phone : {{ Auth::user()->no_wa }}</span>
                            </div>
                        </div>

                        <span class="block mx-auto mb-3 text-sm italic font-light text-center text-grayTheme">Bergabung
                            sejak {{ Auth::user()->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- ====== Profile Section -->
                </div>
            </div>
        </div>

    </div>
</x-home.layout>
