<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/restoran', 'HomeController::index', ['filter' => 'authGuard']);
$routes->get('/restoran/(:any)', 'HomeController::index/$1', ['filter' => 'authGuard']);
$routes->get('/makanan/(:any)', 'HomeController::makanan/$1', ['filter' => 'authGuard']);
$routes->get('/customer', 'CustomerController::index');
$routes->get('/login', 'AuthController::index');
$routes->match(['get', 'post'], 'AuthController/loginAuth', 'AuthController::loginAuth');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/pemesananAPI/?(:any)?', 'PemesananController::index/$1');