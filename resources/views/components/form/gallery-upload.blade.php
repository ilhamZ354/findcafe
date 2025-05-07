@props([
    'values' => [],
])


<div id="galleryUploader" class="space-y-2">
    <label class="block text-sm font-medium text-gray-700">Gallery Foto</label>

    <!-- PREVIEW GAMBAR -->
    <div id="previewContainer" class="grid grid-cols-2 gap-3 md:grid-cols-3"></div>

    <!-- Input file disembunyikan -->
    <input type="file" id="imageInput" class="hidden" accept="image/*" multiple />

    <!-- Tombol upload -->
    <button type="button" id="uploadButton" class="hidden px-4 py-2 text-white rounded bg-primary hover:bg-secondary">
        Upload Semua Gambar
    </button>

    <!-- HASIL UPLOAD -->
    <div id="uploadedContainer" class="grid grid-cols-2 gap-3 pt-2 md:grid-cols-3">
        @if (isset($values) && count($values) > 0)
            @foreach ($values as $value)
                <div class="relative overflow-hidden border rounded">
                    <img src="{{ $value }}" alt="gallery" class="object-cover w-full h-32">
                    <span
                        class="absolute block w-10 h-10 p-1 text-center text-white bg-red-500 rounded-full cursor-pointer remove-button top-1 right-1 hover:bg-opacity-80"
                        data-url="{{ $value }}">x</span>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Hidden input untuk dikirim ke form -->
    <input type="hidden" name="galleries" id="uploadedUrls" value="{{ json_encode($values) }}">

    @error('galleries')
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>

{{-- script in resource/js/handleGalleryUpload.js (import via app.js) --}}
