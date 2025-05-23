<x-home.layout title="Chat Cafe" :footer="false" :navbar="false">
    <div class="flex items-center justify-center w-full h-screen bg-gray-700 bg-center bg-no-repeat bg-cover bg-blend-multiply"
        style="background-image: url('/images/background-cafe.jpg')" loading="lazy">

        <div class="flex flex-col w-1/2 max-w-2xl bg-white rounded-lg">
            <header class="flex items-center justify-start gap-3 px-4 py-1 rounded-t-lg bg-lightPrimaryBrown">
                <x-button.back-pages href="http://localhost:8000/home#services" />
                <h1 class="text-2xl font-medium tracking-wide text-primaryBrown">Nama Cafe</h1>
            </header>
            <hr>

            {{-- Ini Livewire Component-nya --}}
            <main class="flex flex-col justify-between h-[calc(100vh-5.5rem)] w-full max-h-[calc(100vh-5.5rem)] px-10 pb-1 mx-auto mb-3">
                <div class="h-full overflow-y-auto hide-scrollbar">
                    @foreach($messages as $message)
                        <div class="chat {{ $message->from_user_id === auth()->id() ? 'chat-end' : 'chat-start' }}">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img src="{{ $message->from_user->profile_photo_url ?? '/default-avatar.png' }}" />
                                </div>
                            </div>
                            <div class="chat-header">
                                {{ $message->from_user->name }}
                                <time class="text-xs opacity-50">{{ $message->created_at->format('H:i') }}</time>
                            </div>
                            <div class="chat-bubble">{{ $message->message }}</div>
                            <div class="opacity-50 chat-footer">Seen</div>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between gap-3 mt-2">
                    <textarea wire:model.defer="messageText" rows="1"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                        placeholder="Type a message..."></textarea>

                    <button type="button" wire:click="sendMessage"
                        class="text-primaryBrown border border-primaryBrown hover:bg-primaryBrown hover:text-white focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown font-medium rounded-full text-sm p-2.5 inline-flex items-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2a1 1 0 0 1 .932.638l7 18a1 1 0 0 1-1.326 1.281L13 19.517V13a1 1 0 1 0-2 0v6.517l-5.606 2.402a1 1 0 0 1-1.326-1.281l7-18A1 1 0 0 1 12 2Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </main>
        </div>
    </div>
</x-home.layout>



