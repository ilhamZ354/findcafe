<!DOCTYPE html>
<html lang="en">

<x-dashboard.header>
    @yield('title-header')
</x-dashboard.header>

@php
    // ===========PENENTUAN BACKGROUND IMAGE==========
    $bgImage = trim($__env->yieldContent('title')) === 'Sign In' ? 'background-cafe.jpg' : 'background-cafe-2.jpg';
@endphp

<body>

    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: @json(session('success')),
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: @json(session('error')),
                });
            });
        </script>
    @endif


    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden bg-gray-700 bg-center bg-no-repeat bg-cover bg-blend-multiply"
        style="background-image: url('/images/{{ $bgImage }}')" loading="lazy">
        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
                    <!-- Breadcrumb Start -->
                    <div class="flex flex-col gap-3 mb-6 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="font-bold text-white text-title-md2">
                            @yield('title')
                        </h2>
                    </div>
                    <!-- Breadcrumb End -->

                    {{ $slot }}

                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
</body>


</html>
