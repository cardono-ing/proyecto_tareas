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