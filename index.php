<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'config/database.php';
require_once 'app/controllers/CardController.php';
require_once 'app/controllers/UserController.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('app/views');
$twig = new Environment($loader);

$pdo = getPDO();

$cardController = new CardController($pdo, $twig);
$userController = new UserController($pdo, $twig);

$cardController->index();
