<?php

namespace App\Http\Controllers;

use Route\Application;

class Controller
{
    public function view($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}