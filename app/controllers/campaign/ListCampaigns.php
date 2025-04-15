<?php

require_once 'app/models/Campaign.php';

class ListCampaigns {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        $campaignModel = new Campaign($this->db);
        $campaigns = $campaignModel->getAllCampaigns();

        include 'app/views/components/header.php';
        include 'app/views/campaign/list.php';
        include 'app/views/components/footer.php';
    }
}
