<?php
session_start();
//var_dump($_SESSION);

require_once 'vendor/autoload.php';
require_once 'config/database.php';
require_once 'app/controllers/CardController.php';
require_once 'app/controllers/UserController.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

$pdo = getPDO();

$ip = $_SERVER['REMOTE_ADDR'];
$page = $_SERVER['REQUEST_URI'];

//$username = isset($_SESSION['id_utilisateur']) 
 //   ? ($_SESSION['user_role'] ?? 'inconnu') . ' - ' . ($_SESSION['email'] ?? 'utilisateur')
  //  : 'visiteur';
$username = isset($_SESSION['id_utilisateur']) 
    ? ($_SESSION['nom'] ?? 'utilisateur')
    : 'visiteur';



$stmt = $pdo->prepare("INSERT INTO logs (username, ip_address, page_visited) VALUES (?, ?, ?)");
$stmt->execute([$username, $ip, $page]);


$loader = new FilesystemLoader('app/views');
$twig = new Environment($loader);

$twig->addFunction(new TwigFunction('asset', function ($path) {
    return '/' . ltrim($path, '/');
}));

$pdo = getPDO();

$cardController = new CardController($pdo, $twig);
$userController = new UserController($pdo, $twig);

//$cardController->index();

$action = $_GET['action'] ?? 'index';

if (method_exists($cardController, $action)) {
    $cardController->$action();
} elseif (method_exists($userController, $action)) {
    $userController->$action();
} else {
    http_response_code(404);
    include 'app/views/errors/404.php';
}
