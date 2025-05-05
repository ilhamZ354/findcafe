@props(['type', 'label'])

<button type="{{ $type }}"
    class="text-white inline-flex items-center bg-primary hover:bg-opacity-80 focus:ring-1 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ $slot }}
    {{ $label }}
</button>
