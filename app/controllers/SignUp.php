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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'adresse e-mail n'est pas valide.";
        }
        elseif (!preg_match('/^(?=.*[A-Z])(?=.*[\W_]).{8,}$/', $password)) {
            $error = "Le mot de passe doit faire au moins 8 caractères, contenir une majuscule et un caractère spécial.";
        }
        elseif ($password !== $confirmPassword) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            require_once 'app/models/User.php';
            $userModel = new User($this->db);

            if ($userModel->emailExists($email)) {
                $error = "Un compte avec cet email existe déjà.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $userModel->create($pseudo, $email, $hashedPassword);
                header("Location: index.php?page=dashboard");
                exit;
            }
        }
    }

    require 'app/views/home.php';
}

}
