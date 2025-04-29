<?php include 'app/views/components/header.php'; ?>

<div class="article-edit-container">
    <h2>Modifier l'article</h2>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="article_title">Titre :</label><br>
        <input type="text" id="article_title" name="article_title" value="<?= htmlspecialchars($article['article_title']) ?>" required><br><br>

        <label for="article_content">Contenu :</label><br>
        <textarea id="article_content" name="article_content" rows="6" required><?= htmlspecialchars($article['article_content']) ?></textarea><br><br>

        <label>
            <input class="checkbox" type="checkbox" name="is_restricted" <?= $article['article_is_restricted'] ? 'checked' : '' ?>>
            Restreindre l'accès ?
        </label><br><br>

        <div>
            <h4>Personnages ayant accès :</h4>
            <?php foreach ($characters as $char): ?>
                <label>
                    <input type="checkbox" name="access_characters[]" value="<?= $char['character_id'] ?>"
                        <?= in_array($char['character_id'], $currentPermissions['characters']) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($char['character_firstname']) ?> <?= htmlspecialchars($char['character_lastname']) ?>
                </label><br>
            <?php endforeach; ?>
        </div>

        <div>
            <h4>Tables ayant accès :</h4>
            <?php foreach ($tables as $table): ?>
                <label>
                    <input type="checkbox" name="access_tables[]" value="<?= $table['game_table_id'] ?>"
                        <?= in_array($table['game_table_id'], $currentPermissions['tables']) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($table['game_table_name']) ?>
                </label><br>
            <?php endforeach; ?>
        </div>

        <br>
        <button type="submit">Enregistrer</button>
    </form>
</div>

<?php include 'app/views/components/footer.php'; ?>
