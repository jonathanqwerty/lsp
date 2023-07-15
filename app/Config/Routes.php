<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Router\RouteCollectionInterface;
use CodeIgniter\Router\RouteGroup;

use App\Controllers\UserController;

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'AuthController::login');

// Admin routes
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\AdminController'); // Mengarahkan ke method dashboard
    $routes->get('tagihan', 'Admin\AdminController::tagihan'); // Menambahkan route untuk tagihan
    $routes->get('pembayaran', 'Admin\AdminController::pembayaran'); // Menambahkan route untuk pembayaran
    $routes->get('konfirmasi/(:num)', 'Admin\AdminController::konfirmasiPembayaran/$1'); // Menambahkan route untuk konfirmasi pembayaran

    // routes manajemen pelanggan admin
    $routes->get('pelanggan/list-pelanggan', 'Admin\PelangganController::index');
    $routes->get('pelanggan/delete/(:segment)', 'Admin\PelangganController::delete/$1');
    $routes->get('pelanggan/edit-pelanggan/(:segment)', 'Admin\PelangganController::edit/$1');
    $routes->post('pelanggan/update/(:segment)', 'Admin\PelangganController::update/$1');


    //routes manajemen tarif
    $routes->get('tarif/list-tarif', 'Admin\TarifController::index');
    $routes->get('tarif/create-tarif', 'Admin\TarifController::create');
    $routes->post('tarif/store', 'Admin\TarifController::store');
    $routes->get('tarif/edit-tarif/(:segment)', 'Admin\TarifController::edit/$1');
    $routes->post('tarif/update/(:segment)', 'Admin\TarifController::update/$1');

});

// User routes
$routes->group('pengguna', ['filter' => 'user'], function ($routes) {
    $routes->get('/', 'User\UserController::index');
    // Add more user routes as needed
});

$routes->get('/login', 'AuthController::Login');
$routes->post('/process-login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::Register');
$routes->post('/process-register', 'AuthController::processRegister');
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
