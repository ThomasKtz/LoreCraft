<?php

require_once 'app/models/Campaign.php';

class ViewCampaign {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        $campaignModel = new Campaign($this->db);
        $campaign = $campaignModel->getCampaignById($_GET['id']);

        include 'app/views/components/header.php';
        include 'app/views/campaign/view.php';
        include 'app/views/components/footer.php';
    }
}
