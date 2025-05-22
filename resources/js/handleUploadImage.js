document.addEventListener("DOMContentLoaded", () => {
    const imageInput = document.getElementById("image_profile_input") || document.getElementById("image_menu_input");
    const imagePreview = document.getElementById("image_profile_preview") || document.getElementById("image_menu_preview");
    const imageInputUrl = document.getElementById("image_profile_url") || document.getElementById("image_menu_url");

    if (!imageInput || !imagePreview || !imageInputUrl) return;

    imageInput.addEventListener("change", async function () {
        const file = this.files[0];
        if (!file) return;

        // Preview gambar
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        };
        reader.readAsDataURL(file);

        // Upload ke server
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
