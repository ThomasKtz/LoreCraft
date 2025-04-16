<?php

require_once 'app/models/Table.php';
require_once 'app/models/Character.php';

class CreateTable {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $tableModel = new Table($this->db);
        $campaignId = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['game_table_name'];
            $characterIds = $_POST['game_table_characters'] ?? [];

            try {
                $tableModel->create($name, $campaignId, $characterIds);
                header("Location: index.php?page=dashboard");
                exit;
            } catch (PDOException $e) {
                $error = "Erreur lors de la création de la table : " . $e->getMessage();
            }
        }

        // Récupérer les personnages de l'utilisateur pour le formulaire
        $characters = $tableModel->getAllCharacters();

        include 'app/views/table/create.php';
    }
}
