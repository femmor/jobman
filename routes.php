<?php

/**
 * Define application routes
 * @return array
 */

// Home route
$router->get('/', 'HomeController@index');

// Auth routes
$router->get('/login', 'AuthController@login');
$router->get('/register', 'AuthController@register');

// Listings routes
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listing', 'ListingController@show');
