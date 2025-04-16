<?php

require_once 'app/models/Table.php';


class EditTable {
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
        $table = $tableModel->getTableById($_GET['id']);
        $characters = $tableModel->getAllCharacters();

        $table['character_ids'] = isset($table['character_ids']) && $table['character_ids'] !== null
        ? explode(',', $table['character_ids'])
        : [];

        $registeredCharacters = [];
        $unregisteredCharacters = [];

        foreach ($characters as $char) {
            if (in_array($char['character_id'], $table['character_ids'])) {
                $registeredCharacters[] = $char;
            } else {
                $unregisteredCharacters[] = $char;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['game_table_name'];
            $characterIds = $_POST['characters'] ?? [];
    
            try {
                $tableModel->update($table['game_table_id'], $name, $characterIds);
                header("Location: index.php?page=dashboard");
                exit;
            } catch (PDOException $e) {
                $error = "Erreur lors de la mise à jour de la table : " . $e->getMessage();
            }
        }
    
        include 'app/views/components/header.php';
        include 'app/views/table/edit.php'; 
        include 'app/views/components/footer.php';
    }
    }