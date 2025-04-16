<?php

require_once 'app/models/Table.php';

class DeleteTable
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function manage()
    {
        if (isset($_GET['id'])) {
            $tableModel = new Table($this->db);
            $tableModel->deleteTableById($_GET['id']);
            header('Location: index.php?page=dashboard');
            exit;
        }
    }
}
