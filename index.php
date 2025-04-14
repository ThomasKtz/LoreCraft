<?php
session_start();

// Déconnexion
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}

// Connexion à la base de données
require_once 'config/Database.php';
$database = new Database();
$db = $database->getConnection();

// Inclusion des contrôleurs
require_once 'app/controllers/SignUp.php';
require_once 'app/controllers/Login.php';
require_once 'app/controllers/Home.php';
require_once 'app/controllers/Admin.php';
// Ajoute ici les autres contrôleurs (Characters, Campaigns, etc.)

// Routeur
$page = filter_input(INPUT_GET, "page");

$routes = [
    "signUp"        => SignUp::class,
    "login"         => Login::class,
    "home"          => Home::class,
    "admin"         => Admin::class

];

$page = filter_input(INPUT_GET, "page") ?? "home";

if (isset($routes[$page])) {
    $controller = new $routes[$page]($db);
    $controller->manage();
} else {
    // Page non trouvée
    echo "Erreur 404 - Page introuvable";
}

