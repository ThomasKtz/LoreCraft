<div class="campaign-container">
    <!-- Description de la campagne -->
    <section class="campaign-header">
        <h1><?= htmlspecialchars($campaign['campaign_name']) ?></h1>
        <p><?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?></p>
        <p class="game-master">Maître du jeu : <?= htmlspecialchars($campaign['user_pseudo'] ?? 'N/A') ?></p>

        <?php if ($campaign['id_game_master'] === $_SESSION['user']['id'] || $_SESSION['user']['role'] === 3): ?>
            <div class="campaign-actions">
                <a href="index.php?page=add_article&id=<?= $campaign['campaign_id'] ?>">➕ Ajouter un article</a>
                <a href="index.php?page=create_table&id=<?= $campaign['campaign_id'] ?>">➕ Ajouter une table</a>
            </div>
        <?php endif; ?>
    </section>

    <hr class="section-divider">

    <!-- Tables de jeu -->
    <section class="tables-section">
        <h2>Tables de la campagne</h2>
        <?php foreach ($tables as $table): ?>
            <div class="table-card">
                <h3><?= htmlspecialchars($table['game_table_name']) ?></h3>

                <?php if ($campaign['id_game_master'] === $_SESSION['user']['id'] || $_SESSION['user']['role'] === 3): ?>
                    <div class="table-actions">
                        <a href="index.php?page=edit_table&id=<?= $table['game_table_id'] ?>">✏️ Modifier</a>
                        <a href="index.php?page=delete_table&id=<?= $table['game_table_id'] ?>">🗑️ Supprimer</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($characters[$table['game_table_id']])): ?>
                    <ul class="character-list">
                        <?php foreach ($characters[$table['game_table_id']] as $char): ?>
                            <li><?= htmlspecialchars($char['character_firstname']) ?> <?= htmlspecialchars($char['character_lastname']) ?> (<?= htmlspecialchars($char['user_pseudo']) ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><em>Aucun personnage assigné.</em></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>

    <hr class="section-divider">

    <!-- Articles -->
    <section class="articles-section">
        <h2>Articles de la campagne</h2>
        <?php foreach ($articles as $article): ?>
            <?php
                $canView = false;
                if ($article["article_is_restricted"] != 1) $canView = true;
                elseif ($_SESSION['user']['id'] == $campaign['id_game_master']) $canView = true;
                else {
                    $perms = $articlePermissions[$article['article_id']] ?? ['tables' => [], 'characters' => []];
                    foreach ($userCharacterIds as $charId)
                        if (in_array($charId, $perms['characters'])) $canView = true;
                    if (!$canView)
                        foreach ($userTableIds as $tableId)
                            if (in_array($tableId, $perms['tables'])) $canView = true;
                }
            ?>
            <?php if ($canView): ?>
                <div class="article-card">
                    <h3><?= htmlspecialchars($article['article_title']) ?></h3>

                    <?php if ($_SESSION['user']['id'] === $campaign['id_game_master'] || $_SESSION['user']['role'] === 3): ?>
                        <div class="article-actions">
                            <a href="index.php?page=edit_article&id=<?= $article['article_id'] ?>">✏️ Modifier</a>
                            <a href="index.php?page=delete_article&id=<?= $article['article_id'] ?>">🗑️ Supprimer</a>
                        </div>
                    <?php endif; ?>

                    <p><?= nl2br(htmlspecialchars($article['article_content'])) ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
</div>
