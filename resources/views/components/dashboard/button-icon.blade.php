@props([
    'color' => 'gray', // default warna
    'text' => 'Button', // default teks
    'method' => 'GET',
    'action' => '#',
    'disabled' => false,
    'id_modal' => '',
    'id_row' => '',
])

@php
    $colorClasses = match ($color) {
        'blue' => 'text-blue-500',
        'red' => 'text-red-500',
        'green' => 'text-green-500',
        'yellow' => 'text-yellow-500',
        default => 'text-gray-700 hover:bg-gray-700 focus:ring-gray-300',
    };
@endphp


@if ($id_modal != '')
    <button type="button" @if ($disabled) disabled @endif data-modal-target="{{ $id_modal }}"
        data-modal-toggle="{{ $id_modal }}"
        class="flex items-center w-full px-4 py-2 text-sm hover:bg-gray-100 {{ $colorClasses }}">
        {{ $slot }}

        {{ $text }}
    </button>
@else
    <form action="{{ $action }}" method="POST" id="deleteForm{{ $id_row }}">
        @csrf
        @method("$method")
        <button type="button" @if ($disabled) disabled @endif
            @if ($method == 'DELETE') onclick="confirmDelete({{ $id_row }})" @endif
            class="flex items-center w-full px-4 py-2 text-sm hover:bg-gray-100 {{ $colorClasses }}">
            {{ $slot }}

            {{ $text }}
        </button>
    </form>
@endif

<script>
    function confirmDelete(id) {
        console.log("button-click")
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data ini akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik "Hapus", kirim form-nya
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
