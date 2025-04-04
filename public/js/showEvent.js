document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".filter-btn");
    const eventCards = document.querySelectorAll(".event-card");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            let selectedType = this.getAttribute("data-type");

            eventCards.forEach(card => {
                if (card.getAttribute("data-type") === selectedType) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });
});
