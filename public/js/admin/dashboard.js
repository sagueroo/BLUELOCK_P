document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".filter-btn");
    const sections = document.querySelectorAll(".dashboard-section");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const target = btn.dataset.target;
            sections.forEach(section => {
                section.classList.remove("active");
                if (section.id === target) section.classList.add("active");
            });
        });
    });
});
