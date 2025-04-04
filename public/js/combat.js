let idCombattant;

const handleClick = async (e) => {
    const target = e.currentTarget;
    const { id: newIdCombattant } = target.children[1].dataset;

    if (idCombattant === newIdCombattant) return;
    idCombattant = newIdCombattant;

    const idCombat = target.children[0].dataset.id;
    const aptitudeName = target.children[2].dataset.id;
    const aptitudeNote = Number(target.children[3].dataset.note);

    try {
        const response = await fetch("/api/fight", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                id_combat: idCombat,
                id_aptitude: aptitudeName,
                id_combattant: idCombattant,
                note: aptitudeNote
            }),
        });

        const data = await response.json();
        if (!data.success) return;

        const healthCombattant2 = [...document.querySelectorAll(".health-combattant")]
            .find(el => el.dataset.id !== idCombattant);

        let healthValue = Math.max(0, Number(healthCombattant2.childNodes[1].textContent) - aptitudeNote);
        healthCombattant2.childNodes[1].textContent = healthValue;

        if (healthValue === 0) {
            const winnerResponse = await fetch("/api/fight/winner", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    id_combat: idCombat,
                    winner: idCombattant,
                    loser: healthCombattant2.dataset.id
                }),
            });

            const winnerData = await winnerResponse.json();
            if (winnerData.success) {
                alert(`The winner iiiis ${winnerData.winner} qui a détruit ${winnerData.loser}`);
                window.location.href = "/combattants";

                document.querySelectorAll(".aptitude").forEach(el => {
                    el.removeEventListener("click", handleClick);
                });
            }
        }
    } catch (error) {
        console.error("Erreur:", error);
    }
};

document.querySelectorAll(".aptitude").forEach(el =>
    el.addEventListener("click", handleClick)
);
