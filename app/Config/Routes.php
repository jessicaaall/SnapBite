<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PageController::index', ['filter' => 'authGuard']);
$routes->get('/cart', 'PageController::cart', ['filter' => 'authGuard']);
$routes->get('/restoran/(:any)', 'PageController::index/$1', ['filter' => 'authGuard']);
$routes->get('/makanan/(:any)', 'PageController::makanan/$1', ['filter' => 'authGuard']);
$routes->get('/customer', 'CustomerController::index');
$routes->get('/login', 'AuthController::index');
$routes->match(['get', 'post'], 'AuthController/loginAuth', 'AuthController::loginAuth');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/cart/addToCart', 'CartController::addToCart', ['filter' => 'authGuard']);
$routes->post('/cart/updateCart', 'CartController::updateCart', ['filter' => 'authGuard']);
$routes->post('/cart/placeOrder', 'CartController::placeOrder', ['filter' => 'authGuard']);
$routes->get('/pemesananAPI/?(:any)?', 'PemesananController::index/$1');
$routes->get('/detailPemesananAPI/?(:any)?', 'DetailPemesananController::index/$1');
