<?php
require_once 'app/models/Article.php';
require_once 'app/models/Campaign.php';
require_once 'app/models/Table.php';
require_once 'app/models/Character.php';

class EditArticle {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        $articleId = $_GET['id'] ?? null;

        if (!$articleId) {
            header("Location: index.php?page=dashboard");
            exit;
        }

        $articleModel = new Article($this->db);
        $article = $articleModel->getArticleById($articleId);

        if (!$article) {
            header("Location: index.php?page=dashboard");
            exit;
        }

        $tableModel = new Table($this->db);
        $tables = $tableModel->getAllTablesByCampaignId($article['id_campaign']);

        $characterModel = new Character($this->db);
        $characters = $characterModel->getCharactersByCampaignId($article['id_campaign']);

        $currentPermissions = $articleModel->getArticlePermissions($articleId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['article_title'] ?? '';
            $content = $_POST['article_content'] ?? '';
            $isRestricted = isset($_POST['is_restricted']) ? 1 : 0;

            $selectedTables = $_POST['access_tables'] ?? [];
            $selectedCharacters = $_POST['access_characters'] ?? [];

            $success = $articleModel->updateArticleWithPermissions(
                $articleId,
                $title,
                $content,
                $isRestricted,
                $selectedTables,
                $selectedCharacters
            );

            if ($success) {
                header("Location: index.php?page=dashboard");
                exit;
            } else {
                $error = "Erreur lors de la mise à jour de l'article.";
            }
        }

        include 'app/views/article/edit.php';
    }
}
