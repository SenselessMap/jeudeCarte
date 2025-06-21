<?php
require_once __DIR__ . '/../models/Card.php';
require_once __DIR__ . '/../../config/database.php';

class CardController {
    private $pdo;
    private $twig;

    public function __construct($pdo, $twig) {
        $this->pdo = $pdo;
        $this->twig = $twig;
    }

    public function index() {
        $cardModel = new Card($this->pdo);
        $cards = $cardModel->getAll();
        $isLoggedIn = isset($_SESSION['id_utilisateur']);

        echo $this->twig->render('card/collection.twig', [
            'cards' => $cards,
            'session' => $_SESSION,
            'isLoggedIn' => $isLoggedIn
        ]);
    }



    public function addCard() {
        //session_start();

        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit;
        }

        //$pdo = getPDO();
        $cardModel = new Card($this->pdo);

        $nom = trim($_POST['nom'] ?? '');
        $manacost = isset($_POST['manacost']) ? (int)$_POST['manacost'] : null;
        $atk = isset($_POST['atk']) ? (int)$_POST['atk'] : null;
        $hp = isset($_POST['hp']) ? (int)$_POST['hp'] : null;
        $evoatk = isset($_POST['evoatk']) ? (int)$_POST['evoatk'] : null;
        $evohp = isset($_POST['evohp']) ? (int)$_POST['evohp'] : null;
        $cardtype = $_POST['cardtype'] ?? '';
        $type = trim($_POST['type'] ?? '');
        $rarity = trim($_POST['rarity'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $evodescription = trim($_POST['evodescription'] ?? '');

        if (!$nom || !$manacost || !$cardtype) {
            die('Remplissez le form');
        }

        $uploadDir = __DIR__ . '/../../public/assets/images/';

        $stmt = $this->pdo->query("SELECT MAX(id_carte) as max_id FROM Carte");
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
            die('Image est requise!!.');
        }

        $evolveImageName = null;
        if (isset($_FILES['evolve_image']) && $_FILES['evolve_image']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['evolve_image']['tmp_name'];
            $ext = strtolower(pathinfo($_FILES['evolve_image']['name'], PATHINFO_EXTENSION));
            if ($ext !== 'png') {
                die('PNG seulement');
            }
            $evolveImageName = $newId . '_evolve.png';
            if (!move_uploaded_file($tmpName, $uploadDir . $evolveImageName)) {
                die('Failed upload');
            }
        }

        $imageUrl = 'assets/images/' . $mainImageName;
        $evoimageUrl = $evolveImageName ? 'assets/images/' . $evolveImageName : null;

        try {
            $cardModel->insertCard(
                $nom,
                $cardtype,
                $imageUrl,
                $evoimageUrl,
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

        header('Location: /');
        exit;
    }


}
