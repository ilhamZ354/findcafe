@props(['cafe_id', 'sum_notification'])

<a href="{{ route('chat-cafe', $cafe_id) }}"
    class="fixed flex flex-col items-center justify-center w-20 h-20 text-sm font-medium text-center border-2 rounded-full shadow-2xl bottom-16 right-16 text-primaryBrown border-primaryBrown bg-lightPrimaryBrown backdrop-blur-md hover:text-white hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 17h6l3 3v-3h2V9h-2M4 4h11v8H9l-3 3v-3H4V4Z" />
    </svg>

    <span class="text-xs">Chat Cafe</span>
    @if ($sum_notification > 0)
        <div
            class="absolute inline-flex items-center justify-center w-8 h-8 text-sm font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1">
            {{ $sum_notification }}</div>
    @endif
</a>
