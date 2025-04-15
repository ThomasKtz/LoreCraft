<?php
class Dashboard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        // Vérification du rôle de l'utilisateur (si besoin)
        $role = $_SESSION['user']['role'];

        // Ici tu peux ajouter de la logique pour afficher certaines choses selon le rôle

        // Affichage du tableau de bord
        require 'app/views/dashboard.php';
    }
}
