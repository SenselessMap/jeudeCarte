<?php
function requireAdmin() {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header('HTTP/1.1 403 Forbidden pas admin!');
        echo "Pas admin NO";
        exit;
    }
}
