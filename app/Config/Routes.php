<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','ProfileController::index',['filter' => 'authGuard']);
$routes->get('/customer', 'CustomerController::index');
$routes->get('/login', 'LoginController::index');
$routes->match(['get', 'post'], 'LoginController/loginAuth', 'LoginController::loginAuth');