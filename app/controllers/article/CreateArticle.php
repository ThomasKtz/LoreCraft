<?php

require_once 'app/models/Article.php';
require_once 'app/models/Campaign.php';

class CreateArticle {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $campaignModel = new Campaign($this->db);
        $campaign = $campaignModel->getCampaignById($_GET['id'] ?? 0);

        if ($campaign === null) {
            header("Location: index.php?page=dashboard");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['article_title'] ?? '');
            $content = trim($_POST['article_content'] ?? '');

            if (!empty($title)) {
                $articleModel = new Article($this->db);
                $success = $articleModel->create($title, $content, $campaign['campaign_id']);

                if ($success) {
                    header("Location: index.php?page=dashboard");
                    exit;
                } else {
                    $error = "Erreur lors de la création de l'article.";
                }
            } else {
                $error = "Le titre de l'article est requis.";
            }
        }

        include 'app/views/article/create.php';
    }
}
