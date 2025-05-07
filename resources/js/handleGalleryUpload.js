document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("imageInput");
    const previewContainer = document.getElementById("previewContainer");
    const uploadedContainer = document.getElementById("uploadedContainer");
    const uploadButton = document.getElementById("uploadButton");
    const uploadedUrlsInput = document.getElementById("uploadedUrls");

    let files = [];
    let previews = [];
    let uploaded = [];
    const stored = localStorage.getItem("uploadedImages");
    if (stored) {
        uploaded = JSON.parse(stored);
        renderUploaded();
        uploadedUrlsInput.value = JSON.stringify(uploaded);
    }

    // Fungsi untuk menampilkan preview
    function renderPreviews() {
        previewContainer.innerHTML = "";

        previews.forEach((src, index) => {
            // membangun component preview
            const wrapper = document.createElement("div");
            wrapper.className = "relative overflow-hidden border rounded";

            const img = document.createElement("img");
            img.src = src;
            img.className = "object-cover w-full h-32";

            const btn = document.createElement("button");
            btn.className =
                "absolute w-10 h-10 p-1 text-white rounded-full bg-primary top-1 right-1 opacity-80 hover:opacity-100";
            btn.innerText = "×";
            btn.addEventListener("click", () => {
                files.splice(index, 1);
                previews.splice(index, 1);
                renderPreviews();
                updateUploadButton();
            });

            // menyusun preview
            wrapper.appendChild(img);
            wrapper.appendChild(btn);
            previewContainer.appendChild(wrapper);
        });

        // Tambahkan tombol tambah jika kurang dari 5
        if (previews.length < 5) {
            const addWrapper = document.createElement("label");
            addWrapper.className =
                "flex items-center justify-center h-32 text-gray-400 border-2 border-dashed rounded cursor-pointer hover:text-gray-600";
            addWrapper.innerHTML = "<span>+</span>";
            addWrapper.appendChild(input);
            previewContainer.appendChild(addWrapper);
        }
    }

    // Fungsi untuk menampilkan tombol upload
    function updateUploadButton() {
        uploadButton.style.display =
            previews.length > 0 ? "inline-block" : "none";
    }

    // ketika user memilih gambar
    input.addEventListener("change", (e) => {
        const selected = Array.from(e.target.files);

        selected.forEach((file) => {
            if (files.length < 5) {
                files.push(file);
                previews.push(URL.createObjectURL(file));
            }
        });

        renderPreviews();
        updateUploadButton();
        input.value = "";
    });

    // ketika user menekan tombol upload
    uploadButton.addEventListener("click", async () => {
        uploadButton.disabled = true;
        const originalText = uploadButton.innerText;
        uploadButton.innerText = "Loading...";

        // upload semua gambar
        for (let i = 0; i < files.length; i++) {
            const formData = new FormData();
            formData.append("image", files[i]);

            try {
                const res = await fetch("/api/upload", {
                    method: "POST",
                    body: formData,
                    headers: {
                        Accept: "application/json",
                    },
                });

                const data = await res.json();

                // jika upload gagal
                if (!data.url) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Gagal upload gambar! Format harus .jpg, .png, .jpeg, .webp dan maksimal 2MB",
                    });
                    continue;
                }

                const existing = uploadedUrlsInput.value
                    ? JSON.parse(uploadedUrlsInput.value)
                    : [];

                const combined = Array.from(new Set([...existing, data.url]));
                uploadedUrlsInput.value = JSON.stringify(combined);

                console.log(combined);

                localStorage.setItem(
                    "uploadedImages",
                    JSON.stringify(combined)
                );
                renderUploaded();
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Terjadi kesalahan saat mengupload gambar.",
                });
            }
        }

        // Bersihkan preview
        files = [];
        previews = [];
        renderPreviews();
        updateUploadButton();

        // Kembalikan tombol ke semula
        uploadButton.disabled = false;
        uploadButton.innerText = originalText;
    });

    // Fungsi untuk menampilkan gambar yang sudah diupload
    function renderUploaded() {
        // Ambil semua URL dari input hidden
        const urls = uploadedUrlsInput.value
            ? JSON.parse(uploadedUrlsInput.value)
            : [];

        uploadedContainer.innerHTML = ""; // Kosongkan dulu

        urls.forEach((url) => {
            const div = document.createElement("div");
            div.className = "relative overflow-hidden border rounded";

            div.innerHTML = `
            <img src="${url}" alt="gallery" class="object-cover w-full h-32">
            <span
                class="absolute block w-10 h-10 p-1 text-center text-white bg-red-500 rounded-full remove-button top-1 right-1 hover:bg-opacity-80 cursor-pointer"
                data-url="${url}">x</span>
        `;

            uploadedContainer.appendChild(div);
        });
    }

    uploadedContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-button")) {
            const url = e.target.getAttribute("data-url");
            const container = e.target.closest("div");

            Swal.fire({
                title: "Hapus Gambar?",
                text: "Gambar ini akan dihapus dari galeri!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e3342f",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus elemen dari DOM
                    container.remove();

                    // Update input hidden
                    let current = [];
                    try {
                        current = JSON.parse(uploadedUrlsInput.value);
                    } catch (e) {
                        current = [];
                    }

                    const updated = current.filter((item) => item !== url);
                    uploadedUrlsInput.value = JSON.stringify(updated);
                    localStorage.setItem(
                        "uploadedImages",
                        JSON.stringify(updated)
                    );

                    Swal.fire(
                        "Terhapus!",
                        "Gambar berhasil dihapus.",
                        "success"
                    );
                }
            });
        }
    });

    // Inisialisasi awal (starting point)
    renderPreviews();
});
