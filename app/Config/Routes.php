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
    $routes->get('/', 'AdminController::index'); // Mengarahkan ke method dashboard
    $routes->get('list', 'AdminController::filter'); // Menampilkan user
    $routes->get('tarif', 'AdminController::tarif');
    $routes->get('tagihan', 'AdminController::tagihan'); // Menambahkan route untuk tagihan
    $routes->get('pembayaran', 'AdminController::pembayaran'); // Menambahkan route untuk pembayaran
    $routes->get('konfirmasi/(:num)', 'AdminController::konfirmasiPembayaran/$1'); // Menambahkan route untuk konfirmasi pembayaran

});

// User routes
$routes->group('pengguna', ['filter' => 'user'], function ($routes) {
    $routes->get('/', 'UserController::index');
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
