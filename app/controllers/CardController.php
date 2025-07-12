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
        $isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';

        echo $this->twig->render('card/index.twig', [
            'cards' => $cards,
            'is_logged_in' => $isLoggedIn,
            'is_admin' => $isAdmin,
            'current_action' => 'index' ,
            'session' => $_SESSION
        ]);
    }



    public function getCard() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo "ID manquant.";
            return;
        }

        $cardModel = new Card($this->pdo);
        $card = $cardModel->getById((int)$_GET['id']);

        if (!$card) {
            http_response_code(404);
            echo "Carte non trouvée.";
            return;
        }

        echo $this->twig->render('card/details.twig', [
            'card' => $card,
            'session' => $_SESSION
        ]);
    }

    public function deleteCard() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo "ID requis.";
            return;
        }

        $cardModel = new Card($this->pdo);
        $cardModel->deleteCard((int)$_GET['id']);

        header("Location: index.php?action=index");
        exit;
    }

    public function updateCard() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Méthodecrash";
            return;
        }

        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        if (!$id) {
            http_response_code(400);
            echo "ID requis.";
            return;
        }

        //garde les images
        $cardModel = new Card($this->pdo);
        $existingCard = $cardModel->getById($id);
        if (!$existingCard) {
            http_response_code(404);
            echo "Carte introuvable.";
            return;
        }

        $uploadDir = __DIR__ . '/../../public/assets/images/';

        $imageUrl = $existingCard['image_url'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if ($ext === 'png') {
                $imageName = $id . '.png';
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
                $imageUrl = 'assets/images/' . $imageName;
            } else {
                die('Only PNG images allowed for main image.');
            }
        }

        $evoImageUrl = $existingCard['evoimage_url'];
        if (isset($_FILES['evolve_image']) && $_FILES['evolve_image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['evolve_image']['name'], PATHINFO_EXTENSION));
            if ($ext === 'png') {
                $evoImageName = $id . '_evolve.png';
                move_uploaded_file($_FILES['evolve_image']['tmp_name'], $uploadDir . $evoImageName);
                $evoImageUrl = 'assets/images/' . $evoImageName;
            } else {
                die('Only PNG images allowed for evolve image.');
            }
        }

        $data = [
            ':nom' => $_POST['nom'] ?? '',
            ':cardtype' => $_POST['cardtype'] ?? '',
            ':image_url' => $imageUrl,
            ':evoimage_url' => $evoImageUrl,
            ':type' => $_POST['type'] ?? '',
            ':rarity' => $_POST['rarity'] ?? '',
            ':atk' => $_POST['atk'] ?? null,
            ':hp' => $_POST['hp'] ?? null,
            ':evoatk' => $_POST['evoatk'] ?? null,
            ':evohp' => $_POST['evohp'] ?? null,
            ':manacost' => $_POST['manacost'] ?? null,
            ':description' => $_POST['description'] ?? '',
            ':evodescription' => $_POST['evodescription'] ?? '',
        ];

        $cardModel->updateCard($id, $data);

        header("Location: index.php?action=index");
        exit;
    }


    public function editCard() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo "ID manquant.";
            exit;
        }

        $cardModel = new Card($this->pdo);
        $card = $cardModel->getById((int)$_GET['id']);

        if (!$card) {
            http_response_code(404);
            echo "Carte non trouvée.";
            exit;
        }

        echo $this->twig->render('admin/modifier.twig', [
            'card' => $card
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
