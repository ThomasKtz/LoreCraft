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

    public function getAllArticlesByCampaignId($campaignId) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id_campaign = ?");
        $stmt->execute([$campaignId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteArticle($articleId) {

        $stmt = $this->db->prepare("DELETE FROM articles_permissions WHERE id_article = ?");
        $stmt->execute([$articleId]);
        $stmt = $this->db->prepare("DELETE FROM articles WHERE article_id = ?");
        $stmt->execute([$articleId]);

    }

    // public function updateArticle($articleId, $title, $content) {
    //     $stmt = $this->db->prepare("UPDATE articles SET article_title = ?, article_content = ? WHERE article_id = ?");
    //     return $stmt->execute([$title, $content, $articleId]);
    // }

    // public function getById($id) {
    //     $stmt = $this->db->prepare("SELECT * FROM articles WHERE article_id = ?");
    //     $stmt->execute([$id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    
    // public function getAllowedTables($articleId) {
    //     $stmt = $this->db->prepare("SELECT id_game_table FROM articles_permissions WHERE id_article = ? AND id_game_table IS NOT NULL");
    //     $stmt->execute([$articleId]);
    //     return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_game_table');
    // }
    
    // public function getAllowedCharacters($articleId) {
    //     $stmt = $this->db->prepare("SELECT id_character FROM articles_permissions WHERE id_article = ? AND id_character IS NOT NULL");
    //     $stmt->execute([$articleId]);
    //     return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_character');
    // }
    
    public function updateArticleWithPermissions($articleId, $title, $content, $isRestricted, $tableIds = [], $characterIds = []) {
        try {
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("UPDATE articles SET article_title = ?, article_content = ?, article_is_restricted = ? WHERE article_id = ?");
            $stmt->execute([$title, $content, $isRestricted, $articleId]);
    
            $this->db->prepare("DELETE FROM articles_permissions WHERE id_article = ?")->execute([$articleId]);
    
            $stmtPerm = $this->db->prepare("INSERT INTO articles_permissions (id_article, id_game_table, id_character) VALUES (?, ?, ?)");
            foreach ($tableIds as $tableId) {
                $stmtPerm->execute([$articleId, $tableId, null]);
            }
            foreach ($characterIds as $charId) {
                $stmtPerm->execute([$articleId, null, $charId]);
            }
    
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur SQL dans updateArticleWithPermissions(): " . $e->getMessage();
            return false;
        }
    }
    
    public function getArticleById($articleId) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE article_id = ?");
        $stmt->execute([$articleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getArticlePermissions($articleId) {
        $stmt = $this->db->prepare("SELECT id_game_table, id_character FROM articles_permissions WHERE id_article = ?");
        $stmt->execute([$articleId]);
    
        $permissions = ['tables' => [], 'characters' => []];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!empty($row['id_game_table'])) {
                $permissions['tables'][] = $row['id_game_table'];
            }
            if (!empty($row['id_character'])) {
                $permissions['characters'][] = $row['id_character'];
            }
        }
        return $permissions;
    }
}