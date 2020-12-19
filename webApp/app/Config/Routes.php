<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->group('', function ($routes) {
	$routes->get('/auth', 'Auth::index');
	$routes->post('/auth/login', 'Auth::login');
	$routes->get('/auth/logout', 'Auth::logout');
});

$routes->group('', ['filter' => 'login'], function ($routes) {
	// home
	$routes->get('/home', 'Home::index');
	// produk
	$routes->get('/produk', 'Produk::index');
	$routes->get('/produk/tambah', 'Produk::tambah');
	$routes->get('/produk/ubah/(:segment)', 'Produk::ubah/$1');
	$routes->post('/produk/save', 'Produk::save');
	$routes->post('/produk/delete', 'Produk::delete');
	$routes->post('/produk/tmp', 'Produk::tmp');
	$routes->post('/produk/savetmp', 'Produk::savetmp');
	$routes->post('/produk/deletetmp', 'Produk::deletetmp');
	// bahan
	$routes->get('/bahan', 'Bahan::index');
	$routes->get('/bahan/tambah', 'Bahan::tambah');
	$routes->get('/bahan/ubah/(:segment)', 'Bahan::ubah/$1');
	$routes->post('/bahan/save', 'Bahan::save');
	$routes->post('/bahan/delete', 'Bahan::delete');
	// penjualan
	$routes->get('/penjualan', 'Penjualan::index');
	$routes->get('/penjualan/tambah', 'Penjualan::tambah');
	$routes->post('/penjualan/save', 'Penjualan::save');
	$routes->post('/penjualan/tmp', 'Penjualan::tmp');
	$routes->post('/penjualan/savetmp', 'Penjualan::savetmp');
	$routes->post('/penjualan/deletetmp', 'Penjualan::deletetmp');
	// pembelian
	$routes->get('/pembelian', 'Pembelian::index');
	$routes->get('/pembelian/tambah', 'Pembelian::tambah');
	$routes->get('/pembelian/ubah/(:segment)', 'Pembelian::ubah/$1');
	$routes->post('/pembelian/save', 'Pembelian::save');
	$routes->post('/pembelian/delete', 'Pembelian::delete');
	$routes->post('/pembelian/tmp', 'Pembelian::tmp');
	$routes->post('/pembelian/savetmp', 'Pembelian::savetmp');
	$routes->post('/pembelian/deletetmp', 'Pembelian::deletetmp');
	// inventaris
	$routes->get('/inventaris', 'Inventaris::index');
	$routes->get('/inventaris/tambah', 'Inventaris::tambah');
	$routes->get('/inventaris/ubah/(:segment)', 'Inventaris::ubah/$1');
	$routes->post('/inventaris/save', 'Inventaris::save');
	$routes->post('/inventaris/delete', 'Inventaris::delete');
	// supplier
	$routes->get('/supplier', 'Supplier::index');
	$routes->get('/supplier/tambah', 'Supplier::tambah');
	$routes->get('/supplier/ubah/(:segment)', 'Supplier::ubah/$1');
	$routes->post('/supplier/save', 'Supplier::save');
	$routes->post('/supplier/delete', 'Supplier::delete');
});

$routes->group('', function ($routes) {
	// inventaris
	$routes->get('/api/inventaris', 'Api::get_inventaris');
	$routes->get('/api/inventaris/(:segment)', 'Api::get_inventaris/$1');
	$routes->post('/api/inventaris', 'Api::post_inventaris');
	$routes->put('/api/inventaris', 'Api::put_inventaris');
	$routes->delete('/api/inventaris/(:segment)', 'Api::delete_inventaris/$1');
	// produk
	$routes->get('/api/produk', 'Api::get_produk');
	// penjualan
	$routes->get('/api/penjualan', 'Api::get_penjualan');
	$routes->get('/api/penjualan/(:segment)', 'Api::get_penjualan/$1');
	$routes->post('/api/penjualan', 'Api::post_penjualan');
	// penjualantmp
	$routes->get('/api/penjualantmp/(:segment)', 'Api::get_penjualanTmp/$1');
	$routes->post('/api/penjualantmp', 'Api::post_penjualanTmp');
	$routes->put('/api/penjualantmp/(:segment)/(:segment)', 'Api::put_penjualanTmp/$1/$2');
	$routes->delete('/api/penjualantmp/(:segment)/(:segment)', 'Api::delete_penjualanTmp/$1/$2');
	// login
	$routes->get('/api/checklogin/(:segment)', 'Api::get_checkLogin/$1');
	$routes->post('/api/login', 'Api::post_login');
	// logout
	$routes->get('/api/logout/(:segment)', 'Api::get_logout/$1');
	// logout
	$routes->get('/api/github/(:segment)', 'Api::get_github/$1');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
