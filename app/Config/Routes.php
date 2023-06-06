<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('antrian-online', 'Home::antrianOnline');
$routes->match(['POST', 'GET'], 'signin', 'AuthController::SignIn');
$routes->match(['POST', 'GET'], 'signup', 'AuthController::SignUp');

$routes->group('dashboard', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->group('users', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'UsersController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'UsersController::update/$1');
        $routes->delete('delete/(:num)', 'UsersController::delete/$1');
    });

    $routes->group('pasien', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'PasienController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'PasienController::update/$1');
        $routes->delete('delete/(:num)', 'PasienController::delete/$1');
    });

    $routes->group('obats', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'ObatsController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'ObatsController::update/$1');
        $routes->delete('delete/(:num)', 'ObatsController::delete/$1');
    });

    $routes->group('jadwal', function($routes) {
        $routes->get('/', 'JadwalController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'JadwalController::update/$1');
    });

    $routes->group('tindakan', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'TindakanController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'TindakanController::update/$1');
        $routes->delete('delete/(:num)', 'TindakanController::delete/$1');
    });

    $routes->group('antrian', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'AntrianController::index');
        $routes->get('get/(:num)', 'AntrianController::getAntrian/$1');
        $routes->match(['POST', 'GET'], 'detail/(:num)', 'AntrianController::detail/$1');
    });

    $routes->group('kunjungan', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'KunjunganController::index');
        $routes->post('resep', 'KunjunganController::tambahResep');
    });

    $routes->group('transaksi', function($routes) {
        $routes->get('/', 'TransaksiController::index');
        $routes->match(['POST', 'GET'], 'pembayaran/(:any)', 'TransaksiController::getTransaksi/$1');
    });

    $routes->group('laporan', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'LaporanController');
    });

    $routes->group('rekam-medis', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'RekamMedisController::index');
    });

    $routes->get('logout', 'DashboardController::Logout');
});

$routes->group('pasien', ['filter' => 'authPasien'], function($routes) {
    $routes->post('antrian-online', 'Home::antrianOnline');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
