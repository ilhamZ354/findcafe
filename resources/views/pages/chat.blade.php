<x-home.layout title="Chat Cafe" :footer=false :navbar=false>
    <div class="flex items-center justify-center w-full h-screen bg-gray-700 bg-center bg-no-repeat bg-cover bg-blend-multiply"
        style="background-image: url('/images/background-cafe.jpg')" loading="lazy">

        <div class="flex flex-col w-1/2 max-w-2xl bg-white rounded-lg">
            <header class="flex items-center justify-start gap-3 px-4 py-1 rounded-t-lg bg-lightPrimaryBrown">
                <x-button.back-pages href="http://localhost:8000/home#services"></x-button.back-pages>
                <h1 class="text-2xl font-medium tracking-wide text-primaryBrown">Nama Cafe</h1>
            </header>
            <hr>
            <main
                class="flex flex-col justify-between h-[calc(100vh-5.5rem)] w-full max-h-[calc(100vh-5.5rem)] px-10 pb-1 mx-auto mb-3 ">
                <div class="h-full overflow-y-auto hide-scrollbar">
                    <div class="chat chat-start ">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/kenobee@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Obi-Wan Kenobi
                            <time class="text-xs opacity-50">12:45</time>
                        </div>
                        <div class="chat-bubble">You were the Chosen One!</div>
                        <div class="opacity-50 chat-footer">Delivered</div>
                    </div>
                    <div class="chat chat-end">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/anakeen@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Anakin
                            <time class="text-xs opacity-50">12:46</time>
                        </div>
                        <div class="chat-bubble">I hate you!</div>
                        <div class="opacity-50 chat-footer">Seen at 12:46</div>
                    </div>
                    <div class="chat chat-start ">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/kenobee@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Obi-Wan Kenobi
                            <time class="text-xs opacity-50">12:45</time>
                        </div>
                        <div class="chat-bubble">You were the Chosen One!</div>
                        <div class="opacity-50 chat-footer">Delivered</div>
                    </div>
                    <div class="chat chat-end">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/anakeen@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Anakin
                            <time class="text-xs opacity-50">12:46</time>
                        </div>
                        <div class="chat-bubble">I hate you!</div>
                        <div class="opacity-50 chat-footer">Seen at 12:46</div>
                    </div>
                    <div class="chat chat-start ">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/kenobee@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Obi-Wan Kenobi
                            <time class="text-xs opacity-50">12:45</time>
                        </div>
                        <div class="chat-bubble">You were the Chosen One!</div>
                        <div class="opacity-50 chat-footer">Delivered</div>
                    </div>
                    <div class="chat chat-end">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/anakeen@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Anakin
                            <time class="text-xs opacity-50">12:46</time>
                        </div>
                        <div class="chat-bubble">I hate you!</div>
                        <div class="opacity-50 chat-footer">Seen at 12:46</div>
                    </div>
                    <div class="chat chat-start ">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/kenobee@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Obi-Wan Kenobi
                            <time class="text-xs opacity-50">12:45</time>
                        </div>
                        <div class="chat-bubble">You were the Chosen One!</div>
                        <div class="opacity-50 chat-footer">Delivered</div>
                    </div>
                    <div class="chat chat-end">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                                <img alt="Tailwind CSS chat bubble component"
                                    src="https://img.daisyui.com/images/profile/demo/anakeen@192.webp" />
                            </div>
                        </div>
                        <div class="chat-header">
                            Anakin
                            <time class="text-xs opacity-50">12:46</time>
                        </div>
                        <div class="chat-bubble">I hate you!</div>
                        <div class="opacity-50 chat-footer">Seen at 12:46</div>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-3">
                    <textarea id="message" rows="1"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                        placeholder="Type a message..."></textarea>

                    {{-- button send --}}
                    <button type="button"
                        class="text-primaryBrown border border-primaryBrown hover:bg-primaryBrown hover:text-white focus:ring-4 focus:outline-none focus:ring-lightPrimaryBrown font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2a1 1 0 0 1 .932.638l7 18a1 1 0 0 1-1.326 1.281L13 19.517V13a1 1 0 1 0-2 0v6.517l-5.606 2.402a1 1 0 0 1-1.326-1.281l7-18A1 1 0 0 1 12 2Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="sr-only">send button</span>
                    </button>
                </div>
            </main>
        </div>
    </div>
</x-home.layout>
