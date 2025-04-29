<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LoreCraft</title>
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
        </ul>
        <?php endif; ?>
    </nav>
</header>

