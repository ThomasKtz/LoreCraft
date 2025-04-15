<h1><?= htmlspecialchars($campaign['campaign_name']) ?></h1>
<p><?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?></p>
<p>Maitre du jeu: <?= htmlspecialchars($campaign['user_pseudo'] ?? 'N/A') ?></p>

<?php if ($campaign['id_game_master'] === $_SESSION['user']['id']):{ ?>
<a href="index.php?page=add_article&id=<?= $campaign['campaign_id'] ?>">Ajouter un article</a>
<?php } endif; ?>


<?php foreach ($articles as $article): ?>
    <?php if($article["article_is_restricted"] !== 1 || $_SESSION['user']['id'] === $campaign['id_game_master']):{ ?>
    <h2><?= htmlspecialchars($article['article_title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($article['article_content'])) ?></p>
    <?php } endif; ?>
<?php endforeach; ?>