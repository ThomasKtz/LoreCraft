<?php
class Logout {
    public function manage() {
        // Démarre la session si ce n'est pas déjà fait
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Détruit toutes les données de session
        $_SESSION = [];
        session_destroy();

        // Redirection vers la page d'accueil ou de login
        header('Location: index.php?page=login');
        exit;
    }
}
