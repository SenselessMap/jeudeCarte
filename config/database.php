<?php
function getPDO() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=tp1_jeudecarte;charset=utf8', 'root', '');
        //$pdo = new PDO(
        //    'mysql:host=sql111.infinityfree.com;dbname=if0_39451327_tp1_jeudecarte;charset=utf8',
        //    'if0_39451327',
        //    'IL4OVE5PIZ3ZA1'
        //);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }
}
