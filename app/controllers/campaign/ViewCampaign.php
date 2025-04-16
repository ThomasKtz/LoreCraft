<?php

require_once 'app/models/Campaign.php';
require_once 'app/models/Article.php';


class ViewCampaign {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        $campaignModel = new Campaign($this->db);
        $campaign = $campaignModel->getCampaignById($_GET['id']);
        $articleModel = new Article($this->db);
        $articles = $articleModel->getAllArticlesByCampaignId($campaign['campaign_id']);
        $tableModel = new Table($this->db);
        $tables = $tableModel->getAllTablesByCampaignId($campaign['campaign_id']);
        $characters = array();
        foreach ($tables as $table) {
            $characters[$table['game_table_id']] = $tableModel->getAllCharactersFromCampaign($table['game_table_id']) ?? array();
        }


        include 'app/views/components/header.php';
        include 'app/views/campaign/view.php';
        include 'app/views/components/footer.php';
    }
}
