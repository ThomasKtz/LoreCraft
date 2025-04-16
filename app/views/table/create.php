<?php include 'app/views/components/header.php'; ?>

<div class="container">
    <h2>Créer une table</h2>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="game_table_name">Nom de la table :</label><br>
        <input type="text" id="game_table_name" name="game_table_name" required><br><br>

        <label for="game_table_characters">Personnages à ajouter :</label><br>
        <select id="game_table_characters" name="game_table_characters[]" multiple>
            <?php foreach ($characters as $character): ?>
                <option value="<?= $character['character_id'] ?>"><?= htmlspecialchars($character['character_firstname'] . ' ' . $character['character_lastname']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Créer la table</button>
    </form>
</div>

<?php include 'app/views/components/footer.php'; ?>
