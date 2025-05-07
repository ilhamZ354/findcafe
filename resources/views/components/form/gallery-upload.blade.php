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
    <div id="uploadedContainer" class="grid grid-cols-2 gap-3 pt-2 md:grid-cols-3"></div>

    <!-- Hidden input untuk dikirim ke form -->
    <input type="hidden" name="galleries" id="uploadedUrls">
    @error('galleries')
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>

{{-- script in resource/js/handleGalleryUpload.js (import via app.js) --}}
