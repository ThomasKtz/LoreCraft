<?php
class SignUp {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function manage() {
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = trim($_POST['pseudo']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
            } else {
                require_once 'app/models/User.php';
                $userModel = new User($this->db);

                if ($userModel->emailExists($email)) {
                    $error = "Un compte avec cet email existe déjà.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $userModel->create($pseudo, $email, $hashedPassword);
                    header("Location: index.php?page=home");
                    exit;
                }

                
            }
        }

        require 'app/views/home.php';
    }
}
