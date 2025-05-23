<?php
session_start();

require_once 'assets/scripts/db.php';
require_once 'assets/scripts/card.php';

$pdo = getPDO();
$cardModel = new Card($pdo);
$cards = $cardModel->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Jeu de carte</title>
  <link rel="stylesheet" href="assets/styles/styles.css" />
</head>
<body>
  <header>
    <?php include 'assets/scripts/vue/nav.php'; ?>
  </header>

  <section class="contenu">
    
    <?php if (isset($_SESSION['id_utilisateur'])): ?>
    <?php include 'assets/scripts/vue/formulaire.php'; ?>
    <?php endif; ?>
    <?php include 'assets/scripts/vue/collection.php'; ?>
  </section>
</body>
</html>
