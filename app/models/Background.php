<?php

class Background {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public static function getAllByCharacterId($db, $id_character) {
        $stmt = $db->prepare("SELECT * FROM backgrounds WHERE id_character = ?");
        $stmt->execute([$id_character]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
