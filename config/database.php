<?php
function getPDO() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=tp1_jeudecarte;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }
}
