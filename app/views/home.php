<?php require_once __DIR__ . '/components/header.php'; ?>

<div class="home-container">
<div class="left">
    <h1>Entrez dans l’univers de LoreCraft</h1>
    <p>
        Plongez au cœur d’un monde où chaque campagne devient une légende.<br><br>
        LoreCraft est votre grimoire numérique : créez des personnages vivants, tissez des histoires inoubliables, et partagez vos récits épiques dans un espace conçu pour les maîtres du jeu comme pour les aventuriers.
        <br><br>
        ✒️ Générez des backgrounds dynamiques,<br>
        🧙‍♂️ Gérez vos parties en toute fluidité,<br>
        📜 Et donnez vie à votre univers !
    </p>
</div>


    <div class="right">
        <div id="form-inscription" class="auth-form">
            <h2>Inscription</h2>
            <?php if (!empty($error)): ?>
                <div class="error-message" >
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="post" action="index.php?page=signUp">
                <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required 
                value="<?= isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : '' ?>">
                <input type="email" name="email" placeholder="Email" required
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
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
