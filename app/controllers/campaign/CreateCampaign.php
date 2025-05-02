<?php

require_once 'app/models/Campaign.php';
require_once 'app/models/ActivityLogger.php';

class CreateCampaign {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function manage() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['campaign_name'] ?? '');
            $description = trim($_POST['campaign_description'] ?? '');

            if (!empty($name)) {
                $campaignModel = new Campaign($this->db);
                $success = $campaignModel->create($name, $description, $_SESSION['user']['id']);
                $logger = new ActivityLogger();
                $logger->log('create_campaign', $_SESSION['user']['id'], [
                'campaign_name' => $name
                ]);

                if ($success) {
                    header("Location: index.php?page=dashboard");
                    exit;
                } else {
                    $error = "Erreur lors de la création de la campagne.";
                }
            } else {
                $error = "Le nom de la campagne est requis.";
            }
        }

        include 'app/views/campaign/create.php';
    }
}
