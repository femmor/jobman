<?php

/**
 * Home Controller
 */

$config = require basePath('config/db.php');
$db = new Database($config);

// Fetches job listings
$listings = $db->query("SELECT * FROM listings LIMIT 6")->fetchAll();

// Load the home view with listings data
loadView('home', ['listings' => $listings]);
