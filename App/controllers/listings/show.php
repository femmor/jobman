<?php

use Framework\Database;

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: /listings");
    exit;
}

// Get params for query
$params = ['id' => $id];

// Fetch the listing from the database
$listing = $db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();

loadView('listings/show', ['listing' => $listing]);
