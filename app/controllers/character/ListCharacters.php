<?php

require_once 'app/models/Character.php';

class ListCharacters {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }
        $characterModel = new Character($this->db);
        $races = $characterModel->getAllRaces();
        $classes = $characterModel->getAllClasses();
        $characters = $characterModel->getAllCharactersByUserId($_SESSION['user']['id']);

        include  'app/views/components/header.php';
        include  'app/views/character/list.php';
        include  'app/views/components/footer.php';
    }
}