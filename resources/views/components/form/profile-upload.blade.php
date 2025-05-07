<div>
    <label for="image_profile" class="block mb-2 text-sm font-medium text-gray-900">Foto Profile Cafe</label>
    <div class="relative w-fit">
        <img src="{{ asset('images/profile-default.png') }}" alt="image-profile-default"
            class="object-cover w-32 h-32 rounded-full" id="image_profile_preview">
        <label for="image_profile_input"
            class="absolute p-1 text-white rounded-full cursor-pointer bottom-1 right-1 bg-grayTheme">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                    d="M4 18V8a1 1 0 0 1 1-1h1.5l1.707-1.707A1 1 0 0 1 8.914 5h6.172a1 1 0 0 1 .707.293L17.5 7H19a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Z" />
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <input type="file" name="image_profile_input" id="image_profile_input" class="hidden" accept="image/*">
        </label>
    </div>
    <input type="hidden" name="image_profile" id="image_profile_url" class="hidden" accept="image/*">
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const imageInput = document.getElementById('image_profile_input');
        const imagePreview = document.getElementById('image_profile_preview');
        const imageInputUrl = document.getElementById('image_profile_url');

        imageInput.addEventListener('change', async function() {
            const file = this.files[0];
            if (!file) return;

            // Tampilkan preview lokal dulu
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Upload gambar ke server
            const formData = new FormData();
            formData.append("image", file);

            try {
                const res = await fetch("/api/upload", {
                    method: "POST",
                    body: formData,
                    headers: {
                        Accept: "application/json",
                    },
                });

                const data = await res.json();

                if (!data.url) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Gagal upload gambar! Format harus .jpg, .png, .jpeg, .webp dan maksimal 2MB",
                    });
                    return;
                }

                // Ganti preview dengan URL dari server
                imagePreview.src = data.url;
                imageInputUrl.value = data.url;

            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Terjadi kesalahan saat mengupload gambar.",
                });
            }
        });
    });
</script>
