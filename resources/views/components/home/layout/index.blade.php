@props(['title' => 'Home'])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<x-home.layout.header>
    {{ $title }}
</x-home.layout.header>

<body>
    <x-home.layout.navbar></x-home.layout.navbar>

    {{-- Pemberitahuan --}}
    @if (request()->get('status') == 'pending')
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Status Pending',
                text: 'Mohon selesaikan pembayaran sebelum batas waktu yang diberikan.',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus parameter 'status' di URL tanpa reload
                    const url = new URL(window.location);
                    url.searchParams.delete('status');
                    window.history.replaceState({}, document.title, url.toString());
                }
            });
        </script>
    @elseif (request()->get('status') == 'success')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran Berhasil',
                text: 'Selamat, pembayaran kamu berhasil.',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus parameter 'status' di URL tanpa reload
                    const url = new URL(window.location);
                    url.searchParams.delete('status');
                    window.history.replaceState({}, document.title, url.toString());
                }
            });
        </script>
    @elseif (request()->get('status') == 'failed')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Pembayaran Gagal',
                text: 'Pembayaran gagal dilakukan. Silahkan coba lagi.',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus parameter 'status' di URL tanpa reload
                    const url = new URL(window.location);
                    url.searchParams.delete('status');
                    window.history.replaceState({}, document.title, url.toString());
                }
            });
        </script>
    @endif

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    <x-home.layout.footer></x-home.layout.footer>

    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
</body>

</html>
