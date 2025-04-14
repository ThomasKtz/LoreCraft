<?php require_once __DIR__ . '/components/header.php'; ?>

<div class="home-container">
    <div class="left">
        <h1>Bienvenue sur LoreCraft</h1>
        <p>
            LoreCraft est une plateforme de gestion narrative pour vos campagnes de jeux de rôle.
            Créez votre personnage, racontez son histoire à travers des backgrounds interactifs,
            échangez avec les autres joueurs et gérez votre univers avec le maître du jeu.
        </p>
    </div>

    <div class="right">
        <!-- Bascule entre formulaire d'inscription et de connexion -->
        <div id="form-inscription" class="auth-form">
            <h2>Inscription</h2>
            <form method="post" action="index.php?page=signUp">
                <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="confirm_password" placeholder=" Confirmation Mot de passe" required>
                <button type="submit">S'inscrire</button>
            </form>
            <p>Déjà un compte ? <button onclick="switchForm('login')">Se connecter</button></p>
        </div>

        <div id="form-connexion" class="auth-form" style="display: none;">
            <h2>Connexion</h2>
            <form method="post" action="index.php?page=login">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
            <p>Pas encore de compte ? <button onclick="switchForm('register')">S'inscrire</button></p>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '/components/footer.php'; ?>
