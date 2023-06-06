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
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('api', 'Api::index');
$routes->post('api/widget_insert', 'Api::widget_insert');
$routes->post('api/sorting', 'Api::sorting');
$routes->post('api/delete', 'Api::delete');
$routes->post('api/update', 'Api::update');
$routes->post('api/insert', 'Api::insert');
$routes->post('api/getData', 'Api::getData');

$routes->get('api/getPages', 'Api::getPages');
$routes->post('api/pagesUpdateSorting', 'Api::pagesUpdateSorting');
$routes->post('api/pagesUpdateStatus', 'Api::pagesUpdateStatus');
$routes->post('api/pagesInsertChild', 'Api::pagesInsertChild');
$routes->post('api/pagesInsertParent', 'Api::pagesInsertParent');
$routes->post('api/pagesSetDefault', 'Api::pagesSetDefault');
$routes->get('api/pagesDetail', 'Api::pagesDetail');
$routes->post('api/pagesDetailUpdate', 'Api::pagesDetailUpdate');
$routes->post('api/pagesDelete', 'Api::pagesDelete');

$routes->get('api/widget', 'Api::widget');
$routes->get('api/widget/section/(:any)', 'Api::widgetSection/$1');
$routes->post('api/widget/update/sorting', 'Api::widgetUpdateSorting');

$routes->get('api/widget/detail/(:any)', 'Api::widgetDetail/$1');
$routes->post('api/widget/update/detail', 'Api::widgetUpdateDetail');
$routes->post('api/widget/insert', 'Api::widgetInsert');
$routes->post('api/widget/delete', 'Api::widgetDelete');
 
$routes->get('api/upload', 'Upload::index');  
$routes->post('api/upload/uploadImages', 'Upload::uploadImages');  
$routes->post('api/upload/removeImages', 'Upload::removeImages'); 

$routes->get('api/setting', 'Api::setting'); 
$routes->post('api/setting/update', 'Api::settingUpdate'); 


$routes->get('api/login', 'Api::login');
$routes->get('config.app', 'Home::config');

$routes->get('thumb.app', 'Home::thumb');

$routes->get('/(:any)', 'Home::index/$1');

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
