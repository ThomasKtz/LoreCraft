<?php
class Logout {
    public function manage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        header('Location: index.php?page=login');
        exit;
    }
}
