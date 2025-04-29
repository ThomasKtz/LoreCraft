<?php

require_once 'app/models/Article.php';

class DeleteArticle {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if (isset($_GET['id'])) {
            $articleModel = new Article($this->db);
            $articleModel->deleteArticle($_GET['id']);
            header('Location: index.php?page=dashboard');
            exit;
        }
    }
}
