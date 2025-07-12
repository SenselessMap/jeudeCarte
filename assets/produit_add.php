<?php
session_start();

require_once __DIR__ . '/../config/database.php';       
require_once __DIR__ . '/../app/helpers/helper.php';  
require_once __DIR__ . '/../app/controllers/CardController.php'; 
require_once __DIR__ . '/../vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../app/views');
$twig = new Environment($loader);

$pdo = getPDO();
requireAdmin(); 
$controller = new CardController($pdo, $twig);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->addCard();  
} else {
    include __DIR__ . '/../app/views/ajoutCarte.php'; 
}
