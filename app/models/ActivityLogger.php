<?php
require_once 'vendor/autoload.php';

class ActivityLogger {
    private $collection;

    public function __construct() {
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $db = $client->selectDatabase('lorecraft_logs');
        $this->collection = $db->selectCollection('activities');
    }

    
    
public function log($action, $userId = null, $details = []) {
    $date = new DateTime();
    $log = [
        'action' => $action,
        'user_id' => $userId,
        'details' => $details,
        'timestamp' => $date->format('Y-m-d H:i:s')
    ];
    $this->collection->insertOne($log);
}

}
