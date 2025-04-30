<?php

class RollDice {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Même si ici on n'en a pas besoin pour les dés, ça garde la cohérence
    }

    public function manage() {
        include 'app/views/tools/rollDice.php';
    }
}
