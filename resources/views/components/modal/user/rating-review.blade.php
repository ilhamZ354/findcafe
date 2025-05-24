<x-modal.modal-template id_modal="rating-modal" title_modal="Beri Rating & Review">
    <form class="p-4 md:p-5" method="POST" action="{{ route('rating-review.store', $cafe_id) }}">
        @csrf
        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Rating --}}
            <div>
                <label for="rating" class="block mb-2 text-sm font-medium text-gray-900">Rating</label>
                <div id="starRating" class="flex items-center space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <label>
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-input" required>
                            <svg class="w-8 h-8 text-gray-300 cursor-pointer star" data-value="{{ $i }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.39-2.462a1 1 0 00-1.175 0l-3.39 2.462c-.784.57-1.838-.197-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.046 9.393c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.285-3.966z" />
                            </svg>
                        </label>
                    @endfor
                </div>
            </div>

            {{-- Review --}}
            <div>
                <label for="review" class="block mb-2 text-sm font-medium text-gray-900">Review</label>
                <textarea id="review" name="review" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                    placeholder="Tulis review Anda di sini..." required>{{ old('review') }}</textarea>
            </div>
        </div>

        {{-- Button Simpan --}}
        <button type="submit"
            class="text-white inline-flex items-center bg-primaryBrown hover:bg-opacity-80 focus:ring-1 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Simpan
        </button>
    </form>
</x-modal.modal-template>

<script>
    const stars = document.querySelectorAll('#starRating .star');
    const inputs = document.querySelectorAll('.rating-input');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.getAttribute('data-value'));

            // Set checked to the corresponding input
            inputs[rating - 1].checked = true;

            // Update star colors
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('text-yellow-400');
                    s.classList.remove('text-gray-300');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });
</script>
