<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LoreCraft</title>
    <meta name="description" content="LoreCraft est une application de gestion de campagnes, personnages et histoires pour jeux de rôle sur table. Organisez, créez et partagez vos univers narratifs.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="LoreCraft – Gestion de campagnes de jeu de rôle">
    <meta property="og:description" content="Gérez vos univers de jeu de rôle comme un maître du lore. Créez des personnages, des campagnes, des articles et bien plus.">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

<header>
    <nav>
        <img class="logo" src="public/assets/logo.png" alt="logo">
        <?php if (isset($_SESSION['user'])): ?>
        <ul>
            <li><a href="index.php?page=home">Accueil</a></li>
            <li><a href="index.php?page=dashboard">Tableau de bord</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="index.php?logout=true" ">Déconnexion</a></li>
            <?php endif; ?>

        </ul>
        <?php endif; ?>
    </nav>
</header>

