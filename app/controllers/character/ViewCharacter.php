<?php

require_once __DIR__ . '/../../models/Character.php';
require_once __DIR__ . '/../../models/Background.php';

class ViewCharacter {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        $id_character = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id_character) {
            echo "ID de personnage invalide.";
            return;
        }

        $characterModel = new Character($this->db);
        $character = $characterModel->getCharacterById($id_character);

        if (!$character) {
            echo "Personnage introuvable.";
            return;
        }

        $backgrounds = Background::getAllByCharacterId($this->db, $id_character);

        include 'app/views/components/header.php';
        include 'app/views/character/view.php';
        include 'app/views/components/footer.php';
    }
}
