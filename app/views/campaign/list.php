<h2>All Campaigns</h2>

<?php foreach ($campaigns as $campaign): ?>
    <div >
        <a href="index.php?page=campaign&id=<?= $campaign['campaign_id'] ?>">
            <strong><?= htmlspecialchars($campaign['campaign_name']) ?></strong><br>
            <?= nl2br(htmlspecialchars($campaign['campaign_description'])) ?><br>
            <small><strong>GM:</strong> <?= htmlspecialchars($campaign['gm_name'] ?? 'N/A') ?></small><br>
        </a>
    </div>
<?php endforeach; ?>
