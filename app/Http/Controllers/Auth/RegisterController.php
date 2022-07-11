<?php

namespace App\Http\Controllers\Auth;

use Route\Application;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        return $this->view('register');
    }
}