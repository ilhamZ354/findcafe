@props(['href', 'label'])

@php
    $isActive = request()->is(trim(parse_url($href, PHP_URL_PATH), '/') . '*');
@endphp

<a href="{{ $href }}"
    class="group relative flex items-center gap-2.5 rounded-xl px-4 py-2 font-medium text-primaryBrown duration-300 ease-in-out hover:bg-semiPrimaryBrown
    {{ $isActive ? 'bg-semiPrimaryBrown bg-opacity-65' : '' }}">
    
    <!-- SVG Icon -->
    <div class="mr-2">
        {{ $slot }}
    </div>

    <!-- Label Text -->
    {{ $label }}
</a>
