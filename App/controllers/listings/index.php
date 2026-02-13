<?php

/**
 * Listings Index Controller
 */

$config = require basePath('config/db.php');
$db = new Database($config);

// Fetches job listings
$listings = $db->query("SELECT * FROM listings")->fetchAll();

loadView('listings/index', ['listings' => $listings]);
