<?php

class Table {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $campaignId, $characterIds = []) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO game_tables (game_table_name, id_campaign) VALUES (?, ?)");
            $stmt->execute([$name, $campaignId]);

            $tableId = $this->db->lastInsertId();

            if (!empty($characterIds)) {
                $stmtLink = $this->db->prepare("INSERT INTO characters_game_tables (id_game_table, id_character) VALUES (?, ?)");
                foreach ($characterIds as $charId) {
                    $stmtLink->execute([$tableId, $charId]);
                }
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getAllCharacters() {
        $stmt = $this->db->query("SELECT * FROM characters");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCharactersByTableId($tableId) {
        $stmt = $this->db->prepare("SELECT c.*, u.user_pseudo FROM characters c 
            LEFT JOIN characters_game_tables cgt ON c.character_id = cgt.id_character
            LEFT JOIN users u ON c.id_user = u.user_id
            WHERE cgt.id_game_table = ?");
        $stmt->execute([$tableId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getAllTablesByCampaignId($campaignId) {
        $stmt = $this->db->prepare("SELECT * FROM game_tables WHERE id_campaign = ?");
        $stmt->execute([$campaignId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTableById($tableId) {
        $stmt = $this->db->prepare("SELECT 
        gt.game_table_name,gt.game_table_id,  
        c.campaign_name, c.campaign_id,
        GROUP_CONCAT(c2.character_id) AS character_ids 
    FROM game_tables gt 
        LEFT JOIN campaigns c ON gt.id_campaign = c.campaign_id
        LEFT JOIN characters_game_tables cgt ON gt.game_table_id = cgt.id_game_table
        LEFT JOIN characters c2 ON cgt.id_character = c2.character_id
    WHERE gt.game_table_id = ?
    GROUP BY gt.game_table_id, gt.game_table_name, c.campaign_name");
        $stmt->execute([$tableId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($tableId, $name, $characterIds = []) {
        try {
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("UPDATE game_tables SET game_table_name = ? WHERE game_table_id = ?");
            $stmt->execute([$name, $tableId]);
    
            $stmt = $this->db->prepare("DELETE FROM characters_game_tables WHERE id_game_table = ?");
            $stmt->execute([$tableId]);
    
    
            if (!empty($characterIds)) {
                $stmtLink = $this->db->prepare("INSERT INTO characters_game_tables (id_game_table, id_character) VALUES (?, ?)");
                foreach ($characterIds as $charId) {
                    $stmtLink->execute([$tableId, $charId]);
                }
            }
    
            $this->db->commit();
            return true;
    
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur SQL dans update(): " . $e->getMessage();
            return false;
        }
    }

    public function deleteTableById($tableId) {
        try {
            $this->db->beginTransaction();

            $stmtLink = $this->db->prepare("DELETE FROM characters_game_tables WHERE id_game_table = ?");
            $stmtLink->execute([$tableId]);

            $stmt = $this->db->prepare("DELETE FROM game_tables WHERE game_table_id = ?");
            $stmt->execute([$tableId]);

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur SQL dans deleteTableById(): " . $e->getMessage();
            return false;
        }
        
    }
    
}
