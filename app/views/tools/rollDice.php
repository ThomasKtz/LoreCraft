<?php include 'app/views/components/header.php'; ?>

<div class="dice-form-container">
    <h2>Lancer plusieurs dés</h2>
    <form id="dice-form">
        <div class="dice-form-group">
            <label>Choisissez vos dés :</label>

            <div class="multi-dice-group">
                <?php foreach ([4, 6, 8, 10, 12, 20, 100] as $type): ?>
                    <div class="dice-option">
                        <label for="d<?= $type ?>">D<?= $type ?> :</label>
                        <input type="number" min="0" max="20" value="0" id="d<?= $type ?>" name="dice[<?= $type ?>]">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <button type="submit" class="btn">Lancer les dés</button>
    </form>

    <div id="dice-results" class="result-container"></div>
</div>

<script>
document.getElementById('dice-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    let resultsHtml = '';
    let total = 0;

    for (const [key, value] of formData.entries()) {
        const match = key.match(/^dice\[(\d+)\]$/);
        if (match && parseInt(value) > 0) {
            const sides = parseInt(match[1]);
            const count = parseInt(value);
            const rolls = [];

            for (let i = 0; i < count; i++) {
                const roll = Math.floor(Math.random() * sides) + 1;
                rolls.push(roll);
                total += roll;
            }

            resultsHtml += `<p><strong>${count}D${sides}</strong> ➜ ${rolls.join(', ')}</p>`;
        }
    }

    resultsHtml += `<hr class="dice-results-divider"><p><strong>Total :</strong> ${total}</p>`;
    document.getElementById('dice-results').innerHTML = resultsHtml || "<p>Aucun dé sélectionné.</p>";
});
</script>

<?php include 'app/views/components/footer.php'; ?>
