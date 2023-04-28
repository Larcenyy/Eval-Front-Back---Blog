<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\RootController;

$router = new AltoRouter();

// Routes
$router->map('GET', '/home', 'HomeController#index', 'home');
$router->map('GET', '/', 'HomeController#index', 'root');

$router->map('GET', '/connect', 'LoginController#index', 'connect');
$router->map('GET', '/logout', 'LoginController#logout', 'logout');
$router->map('GET', '/admin', 'AdminController#index', 'admin');

$router->map('GET', '/createArticle', 'AdminController#pageCreateArticle', 'createArticle');
$router->map('GET', '/deleteArticle', 'AdminController#pageDeleteArticle', 'deleteArticle');

$router->map('GET', '/articles/delete/[i:id]', 'AdminController#deleteArticle', 'article_delete');
$router->map('GET', '/comment/delete/[i:id]', 'AdminController#deleteComment', 'comment_delete');
$router->map('POST', '/articles/modifyArticle/[i:id]', 'AdminController#modifyArticle', 'modifyArticle');

$router->map('GET', '/articles/modify/[i:id]', 'AdminController#viewModify', 'article_modify');

$router->map('POST', '/login', 'LoginController#checkLogin', 'login');
$router->map('POST', '/validateregister', 'LoginController#registerUser', 'registerUser');
$router->map('GET', '/register', 'LoginController#indexRegister', 'register');


$router->map('POST', '/articles/create', 'AdminController#createArticle', 'create');

$router->map('POST', '/sendMessage/[i:id]', 'ArticlesController#sendMessage', 'sendMessage');


$router->map('GET', '/articles/view/[i:id]', 'ArticlesController#view', 'articles_view');


// Fonction



$match = $router->match();

if ($match) {
    list($controller, $action) = explode('#', $match['target']);
    $controllerFile = dirname(__FILE__) . "/../Controller/$controller.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerClass = "App\\Controller\\$controller";
        $controllerInstance = new $controllerClass();
        call_user_func_array(array($controllerInstance, $action), $match['params']);
    } else {
        $rootController = new RootController();
        $rootController->displayError(404);
    }
} else {
    $rootController = new RootController();
    $rootController->displayError(404);
}
