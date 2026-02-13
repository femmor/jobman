<?php

// Autoloading using Composer (PSR-4 compliant)
require __DIR__ . '/../vendor/autoload.php';

/**
 * Router Initialization & Database Connection
 */

require '../helpers.php';

use Framework\Database;
use Framework\Router;

// Register Autoloader for Framework Classes
// spl_autoload_register(function ($class) {
//     $path = basePath('Framework/' . str_replace('\\', '/', $class) . '.php');

//     if (file_exists($path)) {
//         require $path;
//     }
// });

// Load Database Configuration
$dbConfig = require basePath('config/db.php');

// Initialize Database
$db = new Database($dbConfig);

// Initialize Router
$router = new Router();

// Load Routes
$routes = require basePath('routes.php');

// Register Routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);
