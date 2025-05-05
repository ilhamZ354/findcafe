<!-- resources/views/components/nav-link.blade.php -->
@props(['href', 'selected', 'label'])

<a href="{{ $href }}" @click="selected = '{{ $selected }}'"
    :class="{
        'bg-semiPrimaryBrown bg-opacity-65': selected === '{{ $label }}'
    }"
    class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2 font-medium text-primaryBrown duration-300 ease-in-out hover:bg-semiPrimaryBrown">
    <!-- SVG Icon -->
    <div class="mr-2">
        {{ $slot }}
    </div>

    <!-- Label Text -->
    {{ $label }}
</a>
