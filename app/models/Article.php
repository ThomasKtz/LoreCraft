<?php

class Article{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($title, $content, $campaignId) {
        $stmt = $this->db->prepare("INSERT INTO articles (article_title, article_content, id_campaign) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $content, $campaignId]);
    }
}