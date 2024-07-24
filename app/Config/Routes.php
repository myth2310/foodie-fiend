<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Recommendation route
$routes->group('/recommendation', function($routes) {
    $routes->get('', 'RecommendationController::index');
    $routes->get('rating/(:num)', 'RecommendationController::rating/$1');
});

$routes->get('/orders', 'OrderController::index');

$routes->get('/test', 'Home::spiner');

$routes->group('/dashboard', function($routes) {
    $routes->get('', 'DashboardController::index', ['as' => 'dashboard']);
    $routes->get('menu', 'DashboardController::menu', ['as' => 'menu']);
    $routes->get('category', 'DashboardController::category', ['as' => 'category']);
    $routes->get('profile', 'DashboardController::profile', ['as' => 'profile']);
    $routes->get('order', 'DashboardController::order', ['as' => 'order']);
});

$routes->group('/data', function($routes) {
    $routes->get('category/(:any)', 'CategoryController::get/$1');
    $routes->post('category', 'CategoryController::add');
    $routes->post('category/delete/(:any)', 'CategoryController::delete/$1');
    $routes->post('menu', 'MenuController::create');
});

// Auth route
$routes->get('/signup', 'AuthController::register');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');

// User group
$routes->group('/users', function($routes) {
    $routes->post('store', 'UserController::store');
    $routes->get('profile', 'UserController::profile', ['as' => 'profile']);
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
});

// Shop group
$routes->group('/stores', function($routes) {
    $routes->get('', 'StoreController::index');
    $routes->get('(:any)', 'StoreController::detail/$1');
    $routes->post('', 'StoreController::create');
});

$routes->group('/orders', function($routes) {
    $routes->get('store', 'OrderController::store');
});

// Menu group
$routes->group('/menus', function($routes) {
    $routes->get('', 'MenuController::index');
    $routes->get('(:any)', 'MenuController::detail/$1');
    $routes->post('', 'MenuController::store');
});

$routes->get('upload', 'MenuController::index');
$routes->post('upload', 'MenuController::upload');

$routes->post('/email', 'EmailController::sendEmail');

$routes->get('/user/dashboard', 'UserController::test', ['as' => 'home']);
$routes->get('/store/dashboard', 'UserController::merchant');

// Payment route
$routes->get('payment', 'PaymentController::index');
$routes->post('payment/notification', 'PaymentController::notification');

$routes->post('checkout', 'OrderController::checkout');