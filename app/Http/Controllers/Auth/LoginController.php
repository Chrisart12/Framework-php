<?php

namespace App\Http\Controllers\Auth;

use Route\Application;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return $this->view('login');
    }
}