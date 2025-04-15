<?php

require_once 'app/models/Character.php';


class CreateCharacter {
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['character_firstname'] ?? '');
            $lastName = trim($_POST['character_lastname'] ?? '');
            $gender = trim($_POST['character_gender'] ?? '');
            $age = trim($_POST['character_age'] ?? '');
            $height = trim($_POST['character_height'] ?? '');
            $weight = trim($_POST['character_weight'] ?? '');
            $race = trim($_POST['character_race'] ?? '');
            $class = trim($_POST['character_class'] ?? '');
            $isNPC = isset($_POST['is_npc']) ? 1 : 0;
            $id_user = $_SESSION['user']['id'];

            if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($age) && !empty($height) && !empty($weight) && !empty($race) && !empty($class)) {
                $characterModel->create($firstName, $lastName, $gender, $age, $height, $weight, $race, $class, $isNPC, $id_user);
                header("Location: index.php?page=dashboard");
                exit;
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
            
        }

        include 'app/views/character/create.php';
    }
}
