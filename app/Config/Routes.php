<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Recommendation route
$routes->group('/recommendations', function($routes) {
    $routes->get('', 'RecommendationController::index');
    $routes->get('rating/(:num)', 'RecommendationController::rating/$1');
    $routes->get('invoke', 'RecommendationController::invokePython');
});

$routes->get('/orders', 'OrderController::index');

$routes->get('/test', 'Home::spiner');

$routes->group('/dashboard', function($routes) {
    $routes->get('', 'DashboardController::index', ['as' => 'dashboard']);
    $routes->get('menu', 'DashboardController::menu', ['as' => 'menu']);
    $routes->group('category', function($routes) {
        $routes->get('', 'DashboardController::category', ['as' => 'category']);
        $routes->get('edit/(:any)', 'CategoryController::edit/$1');
    });
    $routes->get('profile', 'DashboardController::profile', ['as' => 'profile']);
    $routes->get('order', 'DashboardController::order', ['as' => 'order']);
});

$routes->group('/data', function($routes) {
    $routes->group('category', function($routes) {
        $routes->post('', 'CategoryController::add');
        $routes->get('', 'CategoryController::get');
        $routes->post('delete/(:any)', 'CategoryController::delete/$1');
        $routes->post('update/(:any)', 'CategoryController::update/$1');
    });
    $routes->post('menu', 'MenuController::create');
});

// Auth route
$routes->post('/register', 'UserController::store');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');

// User group
$routes->group('/user', function($routes) {
    $routes->group('dashboard', function($routes) {
        $routes->get('', 'UserController::dashboard', ['as' => 'home']);
        $routes->get('chart', 'UserController::charts', ['as' => 'my_chart']);
        $routes->get('order', 'UserController::orders', ['as' => 'my_order']);
        $routes->get('setting', 'UserController::settings', ['as' => 'my_setting']);
    });
    $routes->get('profile', 'UserController::profile', ['as' => 'profile']);
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
});

// Shop group
$routes->group('/stores', function($routes) {
    $routes->get('(:any)', 'StoreController::detail/$1');
    $routes->post('', 'StoreController::create');
});

$routes->group('/orders', function($routes) {
    $routes->get('create', 'OrderController::create');
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

// Payment route
$routes->group('payment', function($routes) {
    $routes->get('', 'PaymentController::index');
    $routes->get('(:any)', 'PaymentController::detail/$1');
    $routes->post('notification', 'PaymentController::notification');
});

// Chart routes
$routes->group('chart', function($routes) {
    $routes->get('', 'ChartController::index');
    $routes->post('add/(:any)', 'ChartController::addToChart/$1');
    $routes->post('remove/(:any)', 'ChartController::removeFromChart/$1');
});