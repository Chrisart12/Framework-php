<?php 

require_once 'helpers/helpers.php';

use Route\Application;
use App\Http\Controllers\PostController;


$app = new Application(dirname(__DIR__));

// $app->router->resolve();

$app->router->get('/', ['App\Http\Controllers\PostController', 'home']);

$app->router->get('/posts', [PostController::class, 'index']);

$app->router->post('/create', ['App\Http\Controllers\PostController', 'create']);

$app->router->get('/register', ['App\Http\Controllers\Auth\RegisterController', 'register']);

$app->router->get('/login', ['App\Http\Controllers\Auth\LoginController', 'login']);

$app->run();


