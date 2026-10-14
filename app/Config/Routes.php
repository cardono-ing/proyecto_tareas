<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('lang/(:segment)', 'Home::lang/$1');

$routes->get('signup', 'Auth::signup');
$routes->post('signup', 'Auth::signupPost');
$routes->get('activate/(:segment)', 'Auth::activate/$1');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');
$routes->get('logout', 'Auth::logout');

$routes->group('profile', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Profile::index');
    $routes->get('confirm', 'Profile::confirm');
    $routes->post('confirm', 'Profile::confirmPost');
    $routes->get('edit', 'Profile::edit');
    $routes->post('edit', 'Profile::editPost');
    $routes->get('password', 'Profile::password');
    $routes->post('password', 'Profile::passwordPost');
    $routes->get('image', 'Profile::image');
    $routes->post('image', 'Profile::imagePost');
    $routes->get('image/delete', 'Profile::imageDelete');
    $routes->post('image/delete', 'Profile::imageDeletePost');
});

$routes->group('users', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('new', 'Users::create');
    $routes->get('(:num)', 'Users::show/$1');
    $routes->get('(:num)/edit', 'Users::edit/$1');
    $routes->post('(:num)/edit', 'Users::update/$1');
    $routes->post('(:num)/delete', 'Users::delete/$1');
});

$routes->group('tasks', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Tasks::index');
    $routes->get('new', 'Tasks::new');
    $routes->post('new', 'Tasks::create');
    $routes->get('(:num)', 'Tasks::show/$1');
    $routes->get('(:num)/edit', 'Tasks::edit/$1');
    $routes->post('(:num)/edit', 'Tasks::update/$1');
    $routes->post('(:num)/delete', 'Tasks::delete/$1');
});

$routes->get('forgot', 'Password::forgot');
$routes->post('forgot', 'Password::forgotPost');
$routes->get('reset/(:segment)', 'Password::reset/$1');
$routes->post('reset/(:segment)', 'Password::resetPost/$1');