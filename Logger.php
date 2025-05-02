<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$databases = $client->listDatabases();

foreach ($databases as $db) {
    echo $db->getName(), "\n";
}
