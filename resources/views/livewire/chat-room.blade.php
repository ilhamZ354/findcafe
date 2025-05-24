<main
    class="flex flex-col justify-between h-[calc(100vh-5.5rem)] w-full max-h-[calc(100vh-5.5rem)] px-10 pb-1 mx-auto mb-3">

    {{-- Container chat dengan polling setiap 3 detik --}}
    <div id="chat-container" wire:poll.100ms="getMessages" class="h-[calc(100vh-9.5rem)] overflow-y-auto hide-scrollbar">
        @foreach ($messages as $message)
            <div wire:key="message-text-{{ $loop->index }}"
                class="chat {{ $message['is_mine'] ? 'chat-end' : 'chat-start' }}">

                @php
                    $profileSrc = $message['is_mine']
                        ? $userImage ?? asset('images/profile-default.png')
                        : $cafeImage ?? asset('images/profile-default.png');
                @endphp

                <div class="chat-image avatar">
                    <div class="w-10 rounded-full">
                        <img alt="profile" src="{{ $profileSrc }}" />
                    </div>
                </div>
                <div class="chat-header">
                    <time class="text-xs opacity-50">{{ $message['time'] }}</time>
                </div>
                <div class="chat-bubble">{{ $message['message'] }}</div>
                <div class="opacity-50 chat-footer">
                    {{ $message['is_mine'] ? ($message['is_read'] ? 'Dibaca' : 'Belum dibaca') : 'Diterima' }}</div>
            </div>
        @endforeach
        {{-- ini akan ditarget scroll-nya --}}
        <div id="scroll-anchor"></div>
    </div>

    {{-- Form input pesan --}}
    <form action="" wire:submit.prevent="sendMessage" class="flex items-center justify-between h-16 gap-3 mt-2">
        <textarea wire:key="message-text-{{ $messageKey }}" wire:model.defer="messageText"
            wire:keydown.enter.prevent="sendMessage" wire:keydown.shift.enter="" rows="1"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
            placeholder="Type a message..." autofocus>
    </textarea>

        <button type="submit"
            class="text-primaryBrown border border-primaryBrown hover:bg-primaryBrown hover:text-white focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown font-medium rounded-full text-sm p-2.5 inline-flex items-center">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M12 2a1 1 0 0 1 .932.638l7 18a1 1 0 0 1-1.326 1.281L13 19.517V13a1 1 0 1 0-2 0v6.517l-5.606 2.402a1 1 0 0 1-1.326-1.281l7-18A1 1 0 0 1 12 2Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </form>
</main>

<script>
    let lastMessageCount = 0;
    setInterval(() => {
        const container = document.getElementById('chat-container');
        const anchor = document.getElementById('scroll-anchor');

        if (container && anchor) {
            const currentCount = container.children.length;
            if (currentCount > lastMessageCount) {
                anchor.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
                lastMessageCount = currentCount;
            }
        }
    }, 300);
</script>
