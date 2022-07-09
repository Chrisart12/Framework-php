<?php 

require_once 'helpers/helpers.php';

use Route\Application;

$app = new Application(dirname(__DIR__));

// $app->router->resolve();

$app->router->get('/', 'home');

$app->router->get('/posts', 'posts');

$app->run();


