<?php

namespace App\Controllers;

class ErrorController
{
    /**
     * 404 not found error
     * @return void
     */
    public function error404()
    {
        loadView('error/404');
    }

    /**
     * 500 internal server error
     * @return void
     */
    public function error500()
    {
        loadView('error/500');
    }

    /**
     * 403 forbidden error
     * @return void
     */
    public function error403()
    {
        loadView('error/403');
    }
}
