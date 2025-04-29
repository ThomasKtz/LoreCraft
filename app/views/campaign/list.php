<div class="campaigns-list-container">
    <h2>Toutes les campagnes</h2>

    <?php foreach ($campaigns as $campaign): ?>
        <div class="campaign-card">
            <a href="index.php?page=campaign&id=<?= $campaign['campaign_id'] ?>">
                <strong><?= htmlspecialchars($campaign['campaign_name']) ?></strong>
                <p><?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?></p>
                <small><strong>MJ :</strong> <?= htmlspecialchars($campaign['gm_name'] ?? 'N/A') ?></small>
            </a>
        </div>
    <?php endforeach; ?>
</div>
