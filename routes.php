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

// Error routes
$router->get('/404', 'ErrorController@error404');
$router->get('/500', 'ErrorController@error500');
$router->get('/403', 'ErrorController@error403');
