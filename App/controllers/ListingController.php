<?php


namespace App\Controllers;

use Framework\Database;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        // Fetches job listings
        $listings = $this->db->query("SELECT * FROM listings")->fetchAll();

        loadView('listings/index', ['listings' => $listings]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    public function show()
    {
        // Get the listing ID from the query parameters
        $id = $_GET['id'] ?? null;
        // If no ID is provided, redirect to the listings page
        if (!$id) {
            header("Location: /listings");
            exit;
        }

        // Get params for query
        $params = ['id' => $id];

        // Fetch the listing from the database
        $listing = $this->db->query("SELECT * FROM listings WHERE id = :id", $params)->fetch();

        loadView('listings/show', ['listing' => $listing]);
    }
}
