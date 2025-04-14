<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LoreCraft</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php 
// Debug session en haut de chaque page
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 3) {
    echo '<a href="index.php?page=admin">Dashboard Admin</a>';
}
?>
