<?php include 'app/views/components/header.php'; ?>

<div class="container">
    <h2>Créer une campagne</h2>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="campaign_name">Nom de la campagne :</label><br>
        <input type="text" id="campaign_name" name="campaign_name" required><br><br>

        <label for="campaign_description">Description :</label><br>
        <textarea id="campaign_description" name="campaign_description" rows="5" required></textarea><br><br>

        <button type="submit">Créer la campagne</button>
    </form>
</div>

<?php include 'app/views/components/footer.php'; ?>
