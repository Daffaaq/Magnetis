const buttons = document.querySelectorAll(".batch-btn");
const cards = document.querySelectorAll(".internship-card");

buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
        // Active styling
        buttons.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const filter = btn.getAttribute("data-filter");

        cards.forEach(card => {
            const batch = card.getAttribute("data-batch");
            card.style.display = (filter === "all" || batch === filter) ? "block" : "none";
        });
    });
});