<?php include 'app/views/components/header.php'; ?>

<div class="create-form-container">
    <h2>Créer un personnage</h2>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="character_firstname">Prenom:</label><br>
        <input type="text" id="character_firstname" name="character_firstname" required><br><br>

        <label for="character_flastname">Nom :</label><br>
        <input type="text" id="character_lastname" name="character_lastname" required><br><br>

        <label for="character_gender">Genre :</label><br>
        <select id="character_gender" name="character_gender" required>
            <option value="1">Homme</option>
            <option value="2">Femme</option>
        </select><br><br>

        <div class="create-form-row">
    <div class="create-form-group">
        <label for="character_age">Âge :</label>
        <input type="number" id="character_age" name="character_age" required>
    </div>

    <div class="create-form-group">
        <label for="character_height">Taille (cm) :</label>
        <input type="number" id="character_height" name="character_height" required>
    </div>

    <div class="create-form-group">
        <label for="character_weight">Poids (kg) :</label>
        <input type="number" id="character_weight" name="character_weight" required>
    </div>
</div>

        <label for="character_race">Race :</label><br>
        <select name="character_race" id="character_race" required>
            <option value="">-- Choisissez une race --</option>
            <?php foreach ($races as $race): ?>
                <option value="<?= $race['race_id'] ?>"><?= htmlspecialchars($race['race_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="character_class">Classe :</label><br>
        <select name="character_class" id="character_class" required>
            <option value="">-- Choisissez une classe --</option>
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['class_id'] ?>"><?= htmlspecialchars($class['class_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <?php if($_SESSION['user']['role'] == 2) { ?>
        <label for="character_is_npc">PNJ ?</label>
        <input type="checkbox" id="character_is_npc" name="character_is_npc"><br><br>
        <?php } ?>

        <button type="submit">Créer le personnage</button>
    </form>
</div>

<?php include 'app/views/components/footer.php'; ?>