@section('title-header', 'Dashboard')

<x-dashboard.layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="flex flex-wrap mx-5 mt-10">
            <!-- card1 -->
            <div class="flex w-full">
                <div class="w-full max-w-full px-3 mt-0">
                    <div class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-gray-700 bg-center bg-no-repeat bg-cover bg-blend-multiply h-[70vh] bg-clip-border pt-28 min-h-[60vh]"
                        style="background-image: url('/images/background-cafe.jpg')">
                        <div
                            class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0 text-center h-full mx-auto max-w-4xl">
                            <h6 class="mb-3 text-2xl font-bold tracking-wider text-white md:text-5xl text-shadow-md">
                                Selamat Datang
                                di
                                Dashboard <span class="text-semiPrimaryBrown">Cafe Hunt</span></h6>
                            <p class="mt-1 text-base font-light md:text-lg text-lightPrimaryBrown">Lihat, pantau, dan
                                kelola seluruh
                                data Cafe
                                Mitra dan data lainnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</x-dashboard.layout>
