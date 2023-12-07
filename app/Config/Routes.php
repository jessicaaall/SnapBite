<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/customer', 'CustomerController::index');
$routes->get('/login', 'LoginController::index');
