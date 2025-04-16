<?php

class Character {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllClasses() {
        $stmt = $this->db->query("SELECT class_id, class_name FROM classes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllRaces() {
        $stmt = $this->db->query("SELECT race_id, race_name FROM races");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($firstName, $lastName, $gender, $age, $height, $weight, $race, $class, $isNPC, $userId) {
        $stmt = $this->db->prepare("INSERT INTO characters (character_firstname, character_lastname, character_gender, character_age, character_height, character_weight, id_race, id_class, character_is_npc, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $gender, $age, $height, $weight, $race, $class, $isNPC, $userId]);
    }

    public function getAllCharactersByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM characters LEFT JOIN races ON characters.id_race = races.race_id LEFT JOIN classes ON characters.id_class = classes.class_id WHERE id_user = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}