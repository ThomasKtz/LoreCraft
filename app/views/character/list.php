<div class="characters-list-container">
    <h2>Tous mes personnages</h2>

    <?php foreach ($characters as $character): ?>
        <div class="character-card">
            <a href="index.php?page=character&id=<?= $character['character_id'] ?>">
                <strong><?= htmlspecialchars($character['character_firstname']) ?> <?= htmlspecialchars($character['character_lastname']) ?></strong><br>
                <small><strong>Classe:</strong> <?= htmlspecialchars($character['class_name']) ?></small><br>
                <small><strong>Race:</strong> <?= htmlspecialchars($character['race_name']) ?></small>
            </a>
        </div>
    <?php endforeach; ?>
</div>
