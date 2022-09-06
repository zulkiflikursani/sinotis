<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Home', 'Home::index');
$routes->get('/Manajemenuser', 'ManajemenUser::index');
$routes->get('/Ruangrapat', 'Ruangrapat::index');
$routes->get('/Undanganrapat', 'UndanganRapat::index');
$routes->get('/Undanganrapat/generateundangan', 'UndanganRapat::generate_undangan');
$routes->get('/tambahrapat', 'UndanganRapat::tambahrapat');
$routes->get('/editrapat/(:any)', 'UndanganRapat::editrapat/$1');
$routes->get('/Datarapat', 'Datarapat::index');
$routes->get('/detailrapat', 'Datarapat::detailrapat');
$routes->get('/Main', 'Main::index');
$routes->get('/googledocview', 'GoogleDocView::index');
$routes->post('/Main', 'Main::index');
$routes->post('/Manajemenuser/addUser', 'ManajemenUser::addUser');
$routes->post('/Manajemenuser/udpateUser', 'ManajemenUser::udpateUser');
$routes->post('/Ruangrapat/addRapat', 'Ruangrapat::addRapat');
$routes->post('/Ruangrapat/editRapat', 'Ruangrapat::editRapat');
$routes->post('/UndanganRapat/addUndangan', 'UndanganRapat::addUndangan');
$routes->get('/Logout', 'Main::logout');

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