<?php
require '../helpers.php';

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
require basePath('router.php');
