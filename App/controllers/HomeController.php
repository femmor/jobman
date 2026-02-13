<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
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
        $listings = $this->db->query("SELECT * FROM listings LIMIT 6")->fetchAll();

        // Load the home view with listings data
        loadView('home', ['listings' => $listings]);
    }
}
