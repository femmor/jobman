<?php

namespace App\Controllers;


class AuthController
{
    public function login()
    {
        loadView('login');
    }

    public function register()
    {
        loadView('register');
    }
}
