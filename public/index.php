<?php

/**
 * Router Initialization
 */

require '../helpers.php';

require basePath('Database.php');

$dbConfig = require basePath('config/db.php');

$db = new Database($dbConfig);

require basePath('Router.php');

$router = new Router();

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
