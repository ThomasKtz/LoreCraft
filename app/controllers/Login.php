<?php

require_once('app/models/User.php');

class Login {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = htmlspecialchars($_POST["email"]);
            $password = $_POST["password"];

            $userModel = new User($this->db);
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['user_password'])) {
                // Authentification réussie
                $_SESSION['user'] = [
                    'id' => $user['user_id'],
                    'pseudo' => $user['user_pseudo'],
                    'email' => $user['user_email'],
                    'role' => $user['id_role']
                ];
                header("Location: index.php?page=dashboard");
                exit;

            } else {
                $error = "Email ou mot de passe incorrect";
                require('app/views/login.php');
            }
        } else {
            require('app/views/home.php');
        }
    }
}
