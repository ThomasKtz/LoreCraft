<h1><?= htmlspecialchars($campaign['campaign_name']) ?></h1>
<p><?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?></p>
<p>Maitre du jeu: <?= htmlspecialchars($campaign['user_pseudo'] ?? 'N/A') ?></p>

<?php if ($campaign['id_game_master'] === $_SESSION['user']['id']):{ ?>
<a href="index.php?page=add_article&id=<?= $campaign['campaign_id'] ?>">Ajouter un article</a>
<a href="index.php?page=create_table&id=<?= $campaign['campaign_id'] ?>">Ajouter une table</a>
<?php } endif; ?>


<?php foreach ($articles as $article): ?>
    <?php if($article["article_is_restricted"] !== 1 || $_SESSION['user']['id'] === $campaign['id_game_master']):{ ?>
    <h2><?= htmlspecialchars($article['article_title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($article['article_content'])) ?></p>
    <?php } endif; ?>
<?php endforeach; ?>


<h2>Liste des tables de <?= htmlspecialchars($campaign['campaign_name']) ?></h2>

<?php foreach ($tables as $table): ?>
    <h3><?= htmlspecialchars($table['game_table_name']) ?></h3>
    <?php if ($campaign['id_game_master'] === $_SESSION['user']['id'] || $_SESSION['user']['role'] === 3) :{ ?>
    <p>
        <a href="index.php?page=edit_table&id=<?= $table['game_table_id'] ?>">Modifier</a>
        <a href="index.php?page=delete_table&id=<?= $table['game_table_id'] ?>">Supprimer</a>
    </p>
    <?php } endif; ?>
    
    <!-- Ajout des personnages -->
    <?php if (!empty($characters[$table['game_table_id']])): ?>
    <p>
        <strong>Personnages à cette table :</strong>
        <ul>
            <?php foreach ($characters[$table['game_table_id']] as $char): ?>
                <li><?= htmlspecialchars($char['character_firstname']) ?> <?= htmlspecialchars($char['character_lastname']) ?> (<?= htmlspecialchars($char['user_pseudo']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    </p>
    <?php else: ?>
    <p><em>Aucun personnage assigné.</em></p>
    <?php endif; ?>

    <?php endforeach; ?>

