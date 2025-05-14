@props(['href'])

<a href="{{ $href }}"
    class="block p-3 border rounded-full text-primaryBrown border-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown w-fit"
    title="Back">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 12h14M5 12l4-4m-4 4 4 4" />
    </svg>
</a>
