<div x-data="galleryUploader" class="space-y-2">
    <label class="block text-sm font-medium text-gray-700">Gallery Foto</label>

    <!-- PREVIEW GAMBAR (sebelum upload) -->
    <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
        <template x-for="(preview, index) in previews" :key="preview">
            <div class="relative overflow-hidden border rounded">
                <img :src="preview" class="object-cover w-full h-32" />
                <button type="button" @click="removePreview(index)"
                    class="absolute w-10 h-10 p-1 text-white rounded-full bg-primary top-1 right-1 opacity-80 hover:opacity-100">×</button>
            </div>
        </template>

        <template x-if="previews.length < 5">
            <label
                class="flex items-center justify-center h-32 text-gray-400 border-2 border-dashed rounded cursor-pointer hover:text-gray-600">
                <input type="file" class="hidden" @change="addImage($event)" accept="image/*" multiple />
                <span>+</span>
            </label>
        </template>
    </div>

    <button type="button" @click="uploadAll" class="px-4 py-2 text-white rounded bg-primary hover:bg-secondary"x
        x-show="previews.length> 0">
        Upload Semua Gambar
    </button>

    <!-- Tampilan gambar setelah berhasil upload -->
    <div class="grid grid-cols-2 gap-3 pt-2 md:grid-cols-3" x-show="uploaded.length > 0">
        <template x-for="(url, index) in uploaded" :key="index">
            <div class="relative overflow-hidden border rounded">
                <img :src="url" class="object-cover w-full h-32" />
                <input type="hidden" name="gallery[]" accept="image/*" :value="url" />
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('galleryUploader', () => ({
            previews: [],
            files: [],
            uploaded: [],

            addImage(e) {
                const input = e.target;
                const selected = Array.from(input.files);

                selected.forEach(file => {
                    if (this.files.length < 5) {
                        this.files.push(file);
                        this.previews.push(URL.createObjectURL(file));
                    }
                });

                // Reset input agar pemilihan ulang tidak memicu file lama lagi
                input.value = null;
            },

            async uploadAll() {
                for (let i = 0; i < this.files.length; i++) {
                    const formData = new FormData();
                    formData.append('image', this.files[i]);

                    try {
                        const res = await fetch('/api/upload', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        const data = await res.json();

                        if (data.url == null || data.url == undefined) {
                            return Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: "Gagal upload gambar! Pastikan gambar berformat .jpg, .png, .jpeg, .webp dan ukuran tidak lebih dari 2MB",
                            })
                        }

                        this.uploaded.push(data.url);
                        console.log(data.url);
                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: "Gagal upload gambar! Pastikan gambar berformat .jpg, .png, .jpeg, .webp dan ukuran tidak lebih dari 2MB",
                        })
                    }
                }

                // Bersihkan preview & files
                this.previews = [];
                this.files = [];
            },

            removePreview(index) {
                console.log(index);
                console.log([...this.files]);
                console.log([...this.previews]);
                this.files.splice(index, 1);
                this.previews.splice(index, 1);
            },
        }))
    });
</script>
