<?php
require_once 'app/models/User.php';
require_once 'app/models/Campaign.php';

class Admin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 3) {
            header("Location: index.php?page=home");
            exit;
        }
    
        $userModel = new User($this->db);
        $campaignModel = new Campaign($this->db);
    
        // Suppression d'un utilisateur
        if (isset($_GET['delete'])) {
            $userModel->deleteUser($_GET['delete']);
            header("Location: index.php?page=admin");
            exit;
        }
        
        // Suppression d'une campagne
        if (isset($_GET['delete_campaign'])) {
            $campaignModel->deleteCampaign($_GET['delete_campaign']);
            header("Location: index.php?page=admin");
            exit;
        }
    
        // Modification
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
            $id = $_POST['user_id'];
            $pseudo = trim($_POST['pseudo']);
            $email = trim($_POST['email']);
            $role = $_POST['role'];
    
            $userModel->updateUser($id, $pseudo, $email, null);
            $userModel->updateUserRole($id, $role);
        }
    
        // Récupérer tous les rôles
        $roles = $userModel->getAllRoles();
        $users = $userModel->getAllUsers();
        $campaigns = $campaignModel->getAllCampaigns();
        require 'app/views/adminDashboard.php';
    }
    
}

