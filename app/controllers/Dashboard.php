<?php
class Dashboard {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $role = $_SESSION['user']['role'];


        require 'app/views/dashboard.php';
    }
}
