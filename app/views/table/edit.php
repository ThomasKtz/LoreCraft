<form method="post" class="table-edit-form">
    <input type="hidden" name="table_id" value="<?= $table['game_table_id'] ?>">

    <label for="game_table_name">Nom de la table:</label>
    <input type="text" id="game_table_name" name="game_table_name" value="<?= $table['game_table_name'] ?>" required>

    <div class="character-selection-wrapper">
        <div>
            <label for="availableCharacters">Personnages disponibles</label>
            <select id="availableCharacters" multiple size="10">
                <?php foreach ($unregisteredCharacters as $character): ?>
                    <option value="<?= $character['character_id'] ?>">
                        <?= htmlspecialchars($character['character_firstname'] . ' ' . $character['character_lastname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="transfer-buttons">
            <button type="button" onclick="moveSelected('availableCharacters', 'registeredCharacters')">Ajouter</button>
            <button type="button" onclick="moveSelected('registeredCharacters', 'availableCharacters')">Retirer</button>
        </div>

        <div>
            <label for="registeredCharacters">Personnages enregistrés</label>
            <select id="registeredCharacters" name="characters[]" multiple size="10">
                <?php foreach ($registeredCharacters as $character): ?>
                    <option value="<?= $character['character_id'] ?>">
                        <?= htmlspecialchars($character['character_firstname'] . ' ' . $character['character_lastname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

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