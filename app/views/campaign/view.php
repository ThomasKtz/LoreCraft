<h1><?= htmlspecialchars($campaign['campaign_name']) ?></h1>
<p><?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?></p>
<p>Maitre du jeu: <?= htmlspecialchars($campaign['user_pseudo'] ?? 'N/A') ?></p>

<a href="index.php?page=add_article&id=<?= $campaign['campaign_id'] ?>">Ajouter un article</a>
