<?php

/**
 * Router Initialization & Database Connection
 */

require '../helpers.php';
require basePath('Framework/Database.php');
require basePath('Framework/Router.php');

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
