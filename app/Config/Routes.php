<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'TodolistController::index');
$routes->post('/create', 'TodolistController::create');
$routes->get('delete/(:num)', 'TodolistController::delete/$1');
$routes->post('update/(:num)', 'TodolistController::update/$1');
$routes->get('updateStatus/(:num)', 'TodolistController::updateStatus/$1');


$routes->get('dashboard', 'DashboardController::index');
$routes->get('send-report', 'DashboardController::sendReport');

$routes->get('/pending', 'TodolistController::pending');
$routes->get('/completed', 'TodolistController::completed');