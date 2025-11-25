<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BlogController::index');
$routes->get('blog', 'BlogController::index');
$routes->get('blog/view/(:num)', 'BlogController::view/$1');

$routes->get('admin/login', 'AdminController::login');
$routes->post('admin/authenticate', 'AdminController::authenticate');
$routes->get('admin/logout', 'AdminController::logout');

$routes->get('dashboard', 'DashboardController::index');
$routes->get('dashboard/create', 'DashboardController::create');
$routes->post('dashboard/store', 'DashboardController::store');
$routes->get('dashboard/edit/(:num)', 'DashboardController::edit/$1');
$routes->post('dashboard/update/(:num)', 'DashboardController::update/$1');
$routes->get('dashboard/delete/(:num)', 'DashboardController::delete/$1');
$routes->get('dashboard/fetchDogImage', 'DashboardController::fetchDogImage');

$routes->get('api/posts', 'ApiController::posts');
$routes->get('debug/info', 'DebugController::info');

