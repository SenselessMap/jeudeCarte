<?php
// test
require_once __DIR__ . '/../models/User.php'; 

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() {
        session_start();

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

        
        include __DIR__ . '/../views/login.php'; 
    }
    public function logout() {
        session_start();
        session_unset();  
        session_destroy();
        header('Location: /login'); // * a voir
        exit;
    }
}