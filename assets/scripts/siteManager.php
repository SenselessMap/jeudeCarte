<?php
    require_once 'db.php';
    require_once 'card.php';

    session_start();

    $pdo = getPDO();
    $cardModel = new Card($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    }

    $cards = $cardModel->getAll();

    include 'vue/collection.php';
?>