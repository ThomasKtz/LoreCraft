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
    
        $characters = [];
        $userCharacterIds = []; 
        $userTableIds = []; 
    
        foreach ($tables as $table) {
            $tableCharacters = $tableModel->getCharactersByTableId($table['game_table_id']) ?? [];
            $characters[$table['game_table_id']] = $tableCharacters;
            foreach ($tableCharacters as $char) {
                if ($char['id_user'] == $_SESSION['user']['id']) {
                    $userCharacterIds[] = $char['character_id'];
                    $userTableIds[] = $table['game_table_id'];
                }
            }


        }
    
        $articlePermissions = [];
        foreach ($articles as $article) {
            $articlePermissions[$article['article_id']] = $articleModel->getArticlePermissions($article['article_id']);
        }
    
        include 'app/views/components/header.php';
        include 'app/views/campaign/view.php';
        include 'app/views/components/footer.php';
    }
    
}
