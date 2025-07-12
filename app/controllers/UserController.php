<?php
require_once __DIR__ . '/../models/User.php'; 

class UserController {
    private $userModel;
    private $twig;
    private $pdo;

    public function __construct($pdo, $twig) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->twig = $twig; 
    }

    public function login() {
        $error = '';


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['mot_de_passe'] ?? '';

            $user = $this->userModel->getUserByEmail($email);

            if ($user && $this->userModel->verifyPassword($password, $user['mot_de_passe'])) {
                session_regenerate_id(true);
                $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                $_SESSION['user_role'] = $user['role'];  
                $_SESSION['nom'] = $user['nom'];      
                $_SESSION['email'] = $user['email'];  
                $_SESSION['date_inscription'] = $user['date_inscription']; 
                header('Location: /SiteCarte/index.php');
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect.';
            }
            
        }

        //echo $this->twig->render('card/login.twig', ['error' => $error]);
        echo $this->twig->render('card/login.twig', ['error' => $error]);

    }

    function requireAdmin() {
        session_start();
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('403 Forbiden. pas admin!');
            echo "Access denied.";
            exit;
        }
    }



    public function logout() {
        session_start();
        session_unset();  
        session_destroy();
        header('Location: /SiteCarte/index.php'); // a voir
        exit;
    }

    public function journal() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('HTTP/1.1 403 Forbidden');
            echo "Accès refusé.";
            exit;
        }

        $stmt = $this->pdo->query("SELECT * FROM Logs ORDER BY date DESC");
        $logs = $stmt->fetchAll();

        echo $this->twig->render('admin/journal.twig', [
            'logs' => $logs,
            'session' => $_SESSION
        ]);
    }

    public function editCard() {
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

        echo $this->twig->render('admin/modifier.twig', [
            'card' => $card,
            'session' => $_SESSION
        ]);
    }

}
