document.addEventListener("DOMContentLoaded", function () {
    const scrollBtn = document.getElementById("scrollToTopBtn");

    // Munculin tombol kalau sudah scroll turun setengah layar
    window.addEventListener("scroll", () => {
        if (window.scrollY > window.innerHeight * 0) {
            scrollBtn.classList.remove("hidden");
        } else {
            scrollBtn.classList.add("hidden");
        }
    });

    // Klik tombol → scroll balik ke atas
    scrollBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

});
