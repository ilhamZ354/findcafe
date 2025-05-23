document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.getElementById("myCarousel");
    const items = carousel.querySelectorAll("[data-mycarousel-item]");
    let currentIndex = 0;

    // Fungsi untuk update tampilan item
    function showItem(index) {
        items.forEach((item, i) => {
            if (i === index) {
                item.classList.remove("hidden");
            } else {
                item.classList.add("hidden");
            }
        });
    }

    // Tampilkan item pertama
    showItem(currentIndex);

    // Auto slide setiap 3 detik
    setInterval(() => {
        currentIndex = (currentIndex + 1) % items.length;
        showItem(currentIndex);
    }, 3000);
});
