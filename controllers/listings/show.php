<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: /listings");
    exit;
}

$params = ['id' => $id];

$listing = $db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();

loadView('listings/show', ['listing' => $listing]);
