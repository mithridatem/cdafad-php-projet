<?php

session_start();

//gérer les routes

include '../vendor/autoload.php';
//Import des ressources
use Dotenv\Dotenv;
use Mithridatem\Routing\Route;
use Mithridatem\Routing\Router;
use Mithridatem\Routing\Exception\RouteNotFoundException;
use Mithridatem\Routing\Exception\UnauthorizedException;
use Mithridatem\Routing\Auth\ArrayGrantChecker;

//Import du fichier .env
$dotenv = Dotenv::createImmutable("../");
$dotenv->load();

//Déclarer les routes
$router = new Router();
//Initialiser les rôles de l'utilisateur
if (!isset($_SESSION["user"]["roles"])) {
    $_SESSION["user"]["roles"]  = ['ROLE_PUBLIC'];
}

$roles = $_SESSION["user"]["roles"];

//Configurer l'accès aux routes en fonction des rôles
$router->setGrantChecker(new ArrayGrantChecker($roles));

$router->map(Route::controller('GET', '/', App\Controller\HomeController::class, 'index'));
$router->map(Route::controller('GET', '/test/{nbr}', App\Controller\HomeController::class, 'test'));
$router->map(Route::controller('GET', '/login', App\Controller\RegisterController::class, 'login'));
$router->map(Route::controller('POST', '/login', App\Controller\RegisterController::class, 'login'));
$router->map(Route::controller('GET', '/register', App\Controller\RegisterController::class, 'register'));
$router->map(Route::controller('POST', '/register', App\Controller\RegisterController::class, 'register'));
$router->map(Route::controller('GET', '/category/add', App\Controller\CategoryController::class, 'addCategorie', ['ROLE_USER', 'ROLE_ADMIN']));
$router->map(Route::controller('POST', '/category/add', App\Controller\CategoryController::class, 'addCategorie', ['ROLE_USER', 'ROLE_ADMIN']));
$router->map(Route::controller('GET', '/category/all', App\Controller\CategoryController::class, 'showAllCategories', ['ROLE_USER', 'ROLE_ADMIN']));
$router->map(Route::controller('GET', '/quizz/add', App\Controller\QuizzController::class, 'addQuizz', ['ROLE_USER', 'ROLE_ADMIN']));
$router->map(Route::controller('POST', '/quizz/add', App\Controller\QuizzController::class, 'addQuizz', ['ROLE_USER', 'ROLE_ADMIN']));
$router->map(Route::controller('GET', '/logout', App\Controller\RegisterController::class, 'logout', ['ROLE_USER', 'ROLE_ADMIN']));
$router->map(Route::controller('GET', '/upload', App\Controller\HomeController::class, 'testUpload'));
$router->map(Route::controller('POST', '/upload', App\Controller\HomeController::class, 'testUpload'));
try {
    $router->dispatch();
} catch (RouteNotFoundException $re) {
    echo $re->getMessage();
} catch (UnauthorizedException $ue) {
    echo $ue->getMessage();
    header("Location: /");
    exit;
}
