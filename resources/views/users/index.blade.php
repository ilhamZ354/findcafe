@section('title-header', 'Dashboard')

<x-layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table One Start -->
                <div class="col-span-12 xl:col-span-8">
                    <div
                        class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-xl font-bold text-black dark:text-white">
                                Users
                            </h4>
                            <button class="px-4 py-2 text-white bg-primary rounded-lg ">
                                Add New
                            </button>
                        </div>
                        <div class="flex flex-col">
                            <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-5">
                                <div class="p-2.5 xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Source</h5>
                                </div>
                                <div class="p-2.5 text-center xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Visitors</h5>
                                </div>
                                <div class="p-2.5 text-center xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Revenues</h5>
                                </div>
                                <div class="hidden p-2.5 text-center sm:block xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Sales</h5>
                                </div>
                                <div class="hidden p-2.5 text-center sm:block xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Conversion</h5>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-5">
                                <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('tailadmin/build/src/images/brand/brand-01.svg') }}"
                                            alt="Brand" />
                                    </div>
                                    <p class="hidden font-medium text-black dark:text-white sm:block">
                                        Google
                                    </p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-black dark:text-white">3.5K</p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-meta-3">$5,768</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-black dark:text-white">590</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-meta-5">4.8%</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-5">
                                <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('tailadmin/build/src/images/brand/brand-02.svg') }}"
                                            alt="Brand" />
                                    </div>
                                    <p class="hidden font-medium text-black dark:text-white sm:block">
                                        Twitter
                                    </p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-black dark:text-white">2.2K</p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-meta-3">$4,635</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-black dark:text-white">467</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-meta-5">4.3%</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-5">
                                <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('tailadmin/build/src/images/brand/brand-03.svg') }}"
                                            alt="Brand" />
                                    </div>
                                    <p class="hidden font-medium text-black dark:text-white sm:block">
                                        Github
                                    </p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-black dark:text-white">2.1K</p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-meta-3">$4,290</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-black dark:text-white">420</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-meta-5">3.7%</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-5">
                                <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('tailadmin/build/src/images/brand/brand-04.svg') }}"
                                            alt="Brand" />
                                    </div>
                                    <p class="hidden font-medium text-black dark:text-white sm:block">
                                        Vimeo
                                    </p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-black dark:text-white">1.5K</p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-meta-3">$3,580</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-black dark:text-white">389</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-meta-5">2.5%</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 sm:grid-cols-5">
                                <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('tailadmin/build/src/images/brand/brand-05.svg') }}"
                                            alt="Brand" />
                                    </div>
                                    <p class="hidden font-medium text-black dark:text-white sm:block">
                                        Facebook
                                    </p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-black dark:text-white">1.2K</p>
                                </div>

                                <div class="flex items-center justify-center p-2.5 xl:p-5">
                                    <p class="font-medium text-meta-3">$2,740</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-black dark:text-white">230</p>
                                </div>

                                <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                    <p class="font-medium text-meta-5">1.9%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Table One End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</x-layout>
