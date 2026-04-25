<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');

// Dashboard (setelah login)
$routes->get('/', 'Dashboard::index', ['filter' => 'auth']); 
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']); 

// Karyawan
$routes->get('/karyawan', 'Karyawan::index', ['filter' => 'auth']);
$routes->get('/karyawan/create', 'Karyawan::create');
$routes->post('/karyawan/store', 'Karyawan::store');
$routes->get('/karyawan/edit/(:num)', 'Karyawan::edit/$1');
$routes->post('/karyawan/update/(:num)', 'Karyawan::update/$1');
$routes->get('/karyawan/delete/(:num)', 'Karyawan::delete/$1');

//Absensi
$routes->get('/absensi', 'Absensi::index');
$routes->get('/absensi/create', 'Absensi::create');
$routes->post('/absensi/store', 'Absensi::store');
$routes->get('/absensi/delete/(:num)', 'Absensi::delete/$1');
$routes->get('/absensi/edit/(:num)', 'Absensi::edit/$1');
$routes->post('/absensi/update/(:num)', 'Absensi::update/$1');

// Cuti
// CUTI
$routes->get('/cuti', 'Cuti::index');
$routes->get('/cuti/create', 'Cuti::create');
$routes->post('/cuti/store', 'Cuti::store');
$routes->get('/cuti/approve/(:num)', 'Cuti::approve/$1');
$routes->get('/cuti/reject/(:num)', 'Cuti::reject/$1');

// Log
$routes->get('/log', 'Log::index', ['filter' => 'auth']);
