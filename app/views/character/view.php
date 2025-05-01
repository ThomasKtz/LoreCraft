    <div class="character-container">
    <div class="character-header">
        <h1><?= $character['character_firstname'] ?> <?= $character['character_lastname'] ?></h1>
    </div>

    <div class="character-info">
        <div><strong>Genre :</strong> <?= $character['character_gender'] === 0 ? 'Homme' : 'Femme' ?></div>
        <div><strong>Âge :</strong> <?= $character['character_age'] ?> ans</div>
        <div><strong>Race :</strong> <?= $character['race_name'] ?></div>
        <div><strong>Classe :</strong> <?= $character['class_name'] ?></div>
        <div><strong>Taille : <?= $character['character_height'] ?></strong></div>
        <div><strong>Poids : <?= $character['character_weight'] ?></strong></div>

    </div>

    <hr class="section-divider">

    <div class="backgrounds-section">
        <h2>Backgrounds</h2>
        <a href="index.php?page=add_background&id_character=<?= $character['character_id'] ?>" class="add-background-btn">+ Ajouter un background</a>

        <?php foreach ($backgrounds as $bg): ?>
        <div class="background-card">
            <h3><?= htmlspecialchars($bg['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($bg['content'])) ?></p>
            <div class="background-actions">
            <a href="index.php?page=edit_background&id=<?= $bg['id'] ?>" class="edit-btn">Modifier</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    </div>
