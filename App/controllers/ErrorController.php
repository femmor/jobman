<?php

namespace App\Controllers;

class ErrorController
{
    public function error404()
    {
        loadView('error/404');
    }

    public function error500()
    {
        loadView('error/500');
    }

    public function error403()
    {
        loadView('error/403');
    }
}
