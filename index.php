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
require_once 'app/controllers/Dashboard.php';
require_once 'app/controllers/campaign/CreateCampaign.php';
require_once 'app/controllers/campaign/ListCampaigns.php';
require_once 'app/controllers/campaign/ViewCampaign.php';
require_once 'app/controllers/article/CreateArticle.php';
require_once 'app/controllers/character/CreateCharacter.php';
// Ajoute ici les autres contrôleurs (Characters, Campaigns, etc.)

// Routeur
$page = filter_input(INPUT_GET, "page");

$routes = [
    "signUp"        => SignUp::class,
    "login"         => Login::class,
    "home"          => Home::class,
    "admin"         => Admin::class,
    "dashboard"     => Dashboard::class,
    "create_campaign" => CreateCampaign::class,
    "listCampaigns" => ListCampaigns::class,
    "campaign"      => ViewCampaign::class,
    "add_article"  => CreateArticle::class,
    "create_character" => CreateCharacter::class
];

$page = filter_input(INPUT_GET, "page") ?? "home";

if (isset($routes[$page])) {
    $controller = new $routes[$page]($db);
    $controller->manage();
} else {
    // Page non trouvée
    echo "Erreur 404 - Page introuvable";
}

