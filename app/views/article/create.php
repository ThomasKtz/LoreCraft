<?php include 'app/views/components/header.php'; ?>

<div class="container">
    <h2>Créer un article pour <?= htmlspecialchars($campaign['campaign_name']) ?></h2>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="article_title">Nom de l'article' :</label><br>
        <input type="text" id="article_title" name="article_title" required><br><br>

        <label for="article_content">Description :</label><br>
        <textarea id="article_content" name="article_content" rows="5" required></textarea><br><br>

        <button type="submit">Créer l'article</button>
    </form>
</div>

<?php include 'app/views/components/footer.php'; ?>
