<?php
require_once __DIR__ . '/../models/User.php'; 

class UserController {
    private $userModel;
    private $twig;

    public function __construct($pdo, $twig) {
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
                $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                header('Location: /');
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect.';
            }
        }

        echo $this->twig->render('card/login.twig', ['error' => $error]);
    }



    public function logout() {
        session_start();
        session_unset();  
        session_destroy();
        header('Location: /'); // a voir
        exit;
    }
}
