<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

//Route responsible for the login
$routes->post('admin/loginAdmin','Admin::loginAdmin');
$routes->get('admin/login', 'Admin::login');
$routes->get('admin/dashboard', 'Admin::dashboard');


//Route Responsible for the Naftemporiki controller
$routes->get('naftemporiki/index', 'Naftemporiki::index');



//Route for read the news with a specific id
$routes->get('/read/(:num)', 'Admin::read/$1');


//Route for confirmation of deletion 
$routes->get('/confirmDelete/(:num)', 'Admin::confirmDelete/$1');


//Actual deletion
$routes->post('/delete/(:num)', 'Admin::delete/$1', ['filter' => 'csrf']);





 

