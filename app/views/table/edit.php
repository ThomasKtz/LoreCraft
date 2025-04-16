<form method="post">
    <input type="hidden" name="table_id" value="<?= $table['game_table_id'] ?>">

    <label for="game_table_name">Nom de la table:</label>
    <input type="text" id="game_table_name" name="game_table_name" value="<?= $table['game_table_name'] ?>" required>

    <div style="display: flex; gap: 20px; align-items: center;">
        <div>
            <div><label for="availableCharacters">Personnages disponibles</label></div>
            <select id="availableCharacters" multiple size="10" style="min-width: 200px;">
                <?php foreach ($unregisteredCharacters as $character): ?>
                    <option value="<?= $character['character_id'] ?>">
                        <?= htmlspecialchars($character['character_firstname'] . ' ' . $character['character_lastname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Boutons de transfert -->
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <button type="button" onclick="moveSelected('availableCharacters', 'registeredCharacters')">→</button>
            <button type="button" onclick="moveSelected('registeredCharacters', 'availableCharacters')">←</button>
        </div>

        <div>
            <Div><label for="registeredCharacters">Personnages enregistrés</label></Div>
            <select id="registeredCharacters" name="characters[]" multiple size="10" style="min-width: 200px;">
                <?php foreach ($registeredCharacters as $character): ?>
                    <option value="<?= $character['character_id'] ?>">
                        <?= htmlspecialchars($character['character_firstname'] . ' ' . $character['character_lastname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>



<script>
document.querySelector("form").addEventListener("submit", function () {
    const registered = document.getElementById("registeredCharacters");

    // Forcer toutes les options à être sélectionnées avant l'envoi
    for (let option of registered.options) {
        option.selected = true;
    }
});
</script>



<script>
function moveSelected(fromId, toId) {
    const from = document.getElementById(fromId);
    const to = document.getElementById(toId);

    Array.from(from.selectedOptions).forEach((option) => {
        to.add(new Option(option.text, option.value));
        from.remove(option.index);
    });
}
</script>

