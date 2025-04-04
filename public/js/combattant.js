document.addEventListener("DOMContentLoaded", function () {
    const btnStartCombat = document.querySelector("#start-combat");
    let selectedCombatants = [];

    btnStartCombat.addEventListener("click", () => {
        document.querySelector("h1").textContent = "Choisissez 2 combattants";
        btnStartCombat.textContent = "Démarrer le combat";
        btnStartCombat.disabled = true;

        document.querySelectorAll(".card").forEach((card) => {
            const link = card.closest("a");

            link.addEventListener("click", (event) => {
                event.preventDefault();

                let id = link.getAttribute("href").split("/").pop();

                if (selectedCombatants.includes(id)) {
                    selectedCombatants = selectedCombatants.filter(c => c !== id);
                    card.classList.remove("shadow-lg", "border-primary");
                } else if (selectedCombatants.length < 2) {
                    selectedCombatants.push(id);
                    card.classList.add("shadow-lg", "border-primary");
                }

                btnStartCombat.disabled = selectedCombatants.length !== 2;
            });
        });
    });

    btnStartCombat.addEventListener("click", () => {
        if (selectedCombatants.length === 2) {
            window.location=`/fight/${selectedCombatants[0]}/${selectedCombatants[1]}`;
        }
    });
});