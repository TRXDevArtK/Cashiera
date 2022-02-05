<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//don't put get except for get method only
$routes->add('/', 'Homepage\Home::index'); //default home
$routes->add('/testing', 'Etc\Testing::index');
$routes->add('/dashboard/laporan-keseluruhan', 'Admin/LaporanKeseluruhan::index');
$routes->add('/dashboard/laporan-penjualan', 'Admin/LaporanPenjualan::index');
$routes->add('/dashboard/laporan-pembelian', 'Admin/LaporanPembelian::index');

$routes->add('/dashboard/produk', 'Admin/Produk::index');
$routes->add('/dashboard/toko', 'Admin/Toko::index');
$routes->add('/dashboard/karyawan', 'Admin/Karyawan::index');
$routes->add('/dashboard/kategori-produk', 'Admin/KategoriProduk::index');
$routes->add('/dashboard/tipe-produk', 'Admin/TipeProduk::index');
$routes->add('/dashboard/jabatan', 'Admin/Jabatan::index');

$routes->add('/dashboard/pengaturan-akun', 'Admin/PengaturanAkun::index');
$routes->add('/dashboard/logout', 'Admin/Logout::index');

//other device
$routes->add('/asd21khkajsd910923ij1lkjsadjasd', 'Services/Access::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
