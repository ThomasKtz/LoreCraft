<?php require_once __DIR__ . '/components/header.php'; ?>

<div class="dashboard-container">
    <h1>Bienvenue dans votre Tableau de bord, <?= $_SESSION['user']['pseudo'] ?>.</h1>
    <div class="cards-container">
        <div class="card">
            <h2>Campagnes</h2>
            <a href="index.php?page=listCampaigns">Voir les campagnes</a>
            <?php if ($_SESSION['user']['role'] !==1 ): ?>
                <a href="index.php?page=create_campaign">Créer une campagne</a>
            <?php endif; ?>
        </div>

        <div class="card">
            <h2>Personnages</h2>
            <a href="index.php?page=myCharacters">Voir mes personnages</a>
            <a href="index.php?page=create_character">Créer un personnage</a>
        </div>

        <div class="card">
            <h2>Outils</h2>
            <a href="index.php?page=roll-dice">Dés virtuels</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/components/footer.php'; ?>
