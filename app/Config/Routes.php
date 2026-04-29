<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================= AUTH =================
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');


// ================= USER (WAJIB LOGIN) =================
$routes->group('', ['filter' => 'auth'], function($routes) {

    // DASHBOARD USER
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // ================= ABSENSI USER =================
    $routes->get('absensi', 'User\Absensi::index');
    $routes->get('absensi/masuk', 'User\Absensi::masuk');
    $routes->get('absensi/pulang/(:num)', 'User\Absensi::pulang/$1');

    // ================= CUTI USER =================
    $routes->get('cuti', 'User\Cuti::index');
    $routes->get('cuti/create', 'User\Cuti::create');
    $routes->post('cuti/store', 'User\Cuti::store');

    // ================= LOG USER =================
    $routes->get('log', 'Log::index');
});


// ================= ADMIN (WAJIB LOGIN) =================
$routes->group('admin', ['filter' => 'auth'], function($routes) {

    // DASHBOARD ADMIN
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // ================= ABSENSI ADMIN =================
    $routes->get('absensi', 'Admin\Absensi::index');
    $routes->get('absensi/edit/(:num)', 'Admin\Absensi::edit/$1');
    $routes->post('absensi/update/(:num)', 'Admin\Absensi::update/$1');
    $routes->get('absensi/delete/(:num)', 'Admin\Absensi::delete/$1');

    // ================= CUTI ADMIN =================
    $routes->get('cuti', 'Admin\Cuti::index');
    $routes->get('cuti/approve/(:num)', 'Admin\Cuti::approve/$1');
    $routes->get('cuti/reject/(:num)', 'Admin\Cuti::reject/$1');

    // ================= LOG ADMIN (opsional) =================
    $routes->get('log', 'Log::index');
});


// ================= KARYAWAN (FIXED) =================
$routes->group('karyawan', ['filter' => 'auth'], function($routes) {

    $routes->get('/', 'Karyawan::index');
    $routes->get('create', 'Karyawan::create');
    $routes->post('store', 'Karyawan::store');
    $routes->get('edit/(:num)', 'Karyawan::edit/$1');
    $routes->post('update/(:num)', 'Karyawan::update/$1');
    $routes->get('delete/(:num)', 'Karyawan::delete/$1');
});