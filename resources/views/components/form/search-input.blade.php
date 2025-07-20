<form class="max-w-xl mx-auto mb-5" id="search-form">
    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>

        <input type="search" id="search" name="search" value="{{ request('search') }}"
            class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-primaryBrown focus:border-primaryBrown"
            placeholder="Masukkan nama cafe favoritmu..." required />

        {{-- Button Reset --}}
        @if (request('search'))
            <a href="/home#services" class="absolute z-10 transition-all right-24 bottom-3">
                <svg class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        @endif

        {{-- 🎤 Voice Button --}}
        <button type="button" id="voiceBtn" class="absolute text-gray-500 right-32 bottom-3 hover:text-gray-700">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M5 8a1 1 0 0 1 1 1v3a4.006 4.006 0 0 0 4 4h4a4.006 4.006 0 0 0 4-4V9a1 1 0 1 1 2 0v3.001A6.006 6.006 0 0 1 14.001 18H13v2h2a1 1 0 1 1 0 2H9a1 1 0 1 1 0-2h2v-2H9.999A6.006 6.006 0 0 1 4 12.001V9a1 1 0 0 1 1-1Z"
                    clip-rule="evenodd" />
                <path d="M7 6a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v5a4 4 0 0 1-4 4h-2a4 4 0 0 1-4-4V6Z" />
            </svg>

        </button>

        <button type="submit"
            class="text-white absolute end-2.5 bottom-2.5 bg-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
            Search
        </button>
    </div>
</form>

{{-- ✅ Voice Recognition + Redirect Logic --}}
<script>
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search');
    const voiceBtn = document.getElementById('voiceBtn');

    // Fungsi untuk redirect dengan #services
    function submitSearchWithAnchor() {
        const query = new URLSearchParams(new FormData(searchForm)).toString();
        window.location.href = `/home?${query}#services`;
    }

    // Tangani submit manual
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        submitSearchWithAnchor();
    });

    // Setup Voice Recognition
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (SpeechRecognition) {
        const recognition = new SpeechRecognition();
        recognition.lang = 'id-ID';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        voiceBtn.addEventListener('click', () => {
            recognition.start();
            voiceBtn.classList.add('animate-pulse');
        });

        recognition.addEventListener('result', event => {
            const transcript = event.results[0][0].transcript;
            searchInput.value = transcript;
            voiceBtn.classList.remove('animate-pulse');

            // Redirect setelah hasil voice masuk
            submitSearchWithAnchor();
        });

        recognition.addEventListener('end', () => {
            voiceBtn.classList.remove('animate-pulse');
        });

        recognition.addEventListener('error', e => {
            console.error('Voice error:', e);
            voiceBtn.classList.remove('animate-pulse');
        });
    } else {
        voiceBtn.disabled = true;
        voiceBtn.title = "Voice recognition tidak didukung di browser ini.";
    }
</script>
