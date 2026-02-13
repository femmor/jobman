<?php

/**
 * Define application routes
 * @return array
 */

$router->get('/', 'App/controllers/home.php');
$router->get('/login', 'App/controllers/login.php');
$router->get('/register', 'App/controllers/register.php');
$router->get('/listings', 'App/controllers/listings/index.php');
$router->get('/listings/create', 'App/controllers/listings/create.php');
$router->get('/listing', 'App/controllers/listings/show.php');
$router->get('404', 'App/controllers/error/404.php');
