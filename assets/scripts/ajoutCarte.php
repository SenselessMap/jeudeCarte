<?php
session_start();
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/card.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../../assets/scripts/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit;
}

$pdo = getPDO();
$cardModel = new Card($pdo);

$nom = trim($_POST['nom'] ?? '');
$manacost = isset($_POST['manacost']) ? (int)$_POST['manacost'] : null;
$atk = isset($_POST['atk']) ? (int)$_POST['atk'] : null;
$hp = isset($_POST['hp']) ? (int)$_POST['hp'] : null;
$evoatk = isset($_POST['evoatk']) ? (int)$_POST['evoatk'] : null;           // evo attack
$evohp = isset($_POST['evohp']) ? (int)$_POST['evohp'] : null;              // evo hp
$cardtype = $_POST['cardtype'] ?? '';
$type = trim($_POST['type'] ?? '');  
$rarity = trim($_POST['rarity'] ?? ''); 
$description = trim($_POST['description'] ?? '');
$evodescription = trim($_POST['evodescription'] ?? '');

if (!$nom || !$manacost || !$cardtype) {
    die('Please fill in all required fields: nom, manacost, and cardtype.');
}

$uploadDir = __DIR__ . '/../../assets/images/';

$stmt = $pdo->query("SELECT MAX(id_carte) as max_id FROM Carte");
$maxId = (int)$stmt->fetchColumn();
$newId = $maxId + 1;

$mainImageName = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['image']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if ($ext !== 'png') {
        die('Only PNG images allowed for main image.');
    }
    $mainImageName = $newId . '.png';
    if (!move_uploaded_file($tmpName, $uploadDir . $mainImageName)) {
        die('Failed to upload main image.');
    }
} else {
    die('Main image is required.');
}

$evolveImageName = null;
if (isset($_FILES['evolve_image']) && $_FILES['evolve_image']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['evolve_image']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['evolve_image']['name'], PATHINFO_EXTENSION));
    if ($ext !== 'png') {
        die('Only PNG images allowed for evolve image.');
    }
    $evolveImageName = $newId . '_evolve.png';
    if (!move_uploaded_file($tmpName, $uploadDir . $evolveImageName)) {
        die('Failed to upload evolve image.');
    }
}

$imageUrl = 'assets/images/' . $mainImageName;
//var_dump($imageUrl); exit;
$evoimage_url = $evolveImageName ? 'assets/images/' . $evolveImageName : null;

try {
    $cardModel->insertCard(
        $nom,
        $cardtype,
        $imageUrl,
        $evoimage_url,
        $type,
        $rarity,
        $atk,
        $hp,
        $evoatk,
        $evohp,
        $manacost,
        $description,
        $evodescription
    );
} catch (Exception $e) {
    die('Failed: ' . $e->getMessage());
}

header('Location: ../../index.php');
exit;
