<?php

/**
 * Define application routes
 * @return array
 */

$router->get('/', 'controllers/home.php');
$router->get('/login', 'controllers/login.php');
$router->get('/register', 'controllers/register.php');
$router->get('/listings', 'controllers/listings/index.php');
$router->get('/listings/create', 'controllers/listings/create.php');
$router->get('404', 'controllers/error/404.php');
