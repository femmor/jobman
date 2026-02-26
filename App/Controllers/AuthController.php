<?php

namespace App\Controllers;


class AuthController
{
    /**
     * Login controller method
     * @return void
     */
    public function login()
    {
        loadView('login');
    }

    /**
     * Register controller method
     * @return void
     */

    public function register()
    {
        loadView('register');
    }
}
