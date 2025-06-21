<?php
// Start
//session_start();


require_once 'vendor/autoload.php'; 

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('app/views');  // Path des views
$twig = new Environment($loader, [
    'cache' => false,  
]);


require_once 'app/controllers/CardController.php';
require_once 'app/controllers/UserController.php';

require_once 'config/database.php';
$pdo = getPDO();


//echo "Requested URI: " . $_SERVER['REQUEST_URI']; 

$cardController = new CardController($pdo, $twig);
$userController = new UserController($pdo, $twig);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

//echo "<br>Parsed URI: " . $uri;

//jai oublié s'il y avait une fonction pour éviter tant de répétition...
if ($uri === '/SiteCarte' || $uri === '/') {
    echo "index found";  
    $cardController->index(); 
} elseif ($uri === '/login') {
    echo "login found";
    $userController->login(); 
} elseif ($uri === '/logout') {
    echo "logout found";
    $userController->logout();
} elseif ($uri === '/') {
    echo "index found";
    $cardController->index(); 
} elseif ($uri === '/add-card') {
    echo "add card found";
    $cardController->addCard();
} else {
    // 404
    //echo "404 Not Found";  
}
