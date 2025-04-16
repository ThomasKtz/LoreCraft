<?php

class Campaign {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $description, $gameMasterId) {
        $stmt = $this->db->prepare("INSERT INTO campaigns (campaign_name, campaign_description, id_game_master)
                VALUES (?, ?, ?)");
        return $stmt->execute([
            $name,
            $description,
            $gameMasterId
        ]);
    }

    public function getAllCampaigns() {
        $stmt = $this->db->prepare("SELECT c.*, u.user_pseudo AS gm_name
                                    FROM campaigns c
                                    LEFT JOIN users u ON c.id_game_master = u.user_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCampaign($id, $name, $description, $gm_id) {
        $stmt = $this->db->prepare("UPDATE campaigns 
                                    SET campaign_name = ?, campaign_description = ?, id_game_master = ?
                                    WHERE campaign_id = ?");
        return $stmt->execute([$name, $description, $gm_id, $id]);
    }

    public function getCampaignById($id) {
        $stmt = $this->db->prepare("SELECT * FROM campaigns LEFT JOIN users ON campaigns.id_game_master = users.user_id WHERE campaign_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCampaign($id) {
        $stmt = $this->db->prepare("DELETE FROM campaigns WHERE campaign_id = ?");
        return $stmt->execute([$id]);
    }
    
}
