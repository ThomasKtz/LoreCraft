<?php
require_once 'app/models/User.php';

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
    
        // Suppression
        if (isset($_GET['delete'])) {
            $userModel->deleteUser($_GET['delete']);
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
        require 'app/views/adminDashboard.php';
    }
    
}
