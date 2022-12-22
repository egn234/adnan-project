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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('logout', 'Login::logout');

$routes->post('login-auth', 'Login::login_proc');
$routes->get('login-check', 'Login::index2');

$routes->group('admin', static function ($routes)
{
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('kategori', 'Admin\Kategori::index');
    $routes->get('list-dosen', 'Admin\Akun::index');
    $routes->get('dokumen', 'Admin\Dokumen::index');
    $routes->get('ruangan', 'Admin\Ruangan::index');
    $routes->get('dokumen-peminjaman', 'Admin\Ruangan::dokumen_peminjaman');
    $routes->get('riwayat_peminjaman', 'Admin\Ruangan::riwayat_peminjaman');
    
    $routes->post('kategori/add-kategori', 'Admin\Kategori::add_proc');
    $routes->post('kategori/edit-kategori-proc/(:num)', 'Admin\Kategori::edit_proc/$1', ['as' => 'admin_edit_kategori']);

    $routes->add('kategori/switch-kategori', 'Admin\Kategori::konfirSwitch');
    $routes->add('kategori/edit-kategori', 'Admin\Kategori::editKategori');
    $routes->add('kategori/switch-kategori-confirm/(:num)', 'Admin\Kategori::flag_switch/$1', ['as' => 'admin_switch_kategori']);
    
    $routes->add('dokumen/sign/(:num)', 'Admin\Dokumen::sign_document/$1', ['as' => 'admin_ttd_dokumen']);
    $routes->add('dokumen/(:num)', 'Admin\Dokumen::detail/$1', ['as' => 'admin_detail_dokumen']);
    
    $routes->post('ruangan/add-ruangan', 'Admin\Ruangan::add_proc');
    $routes->add('ruangan/edit-ruangan', 'Admin\Ruangan::editRuangan');
    $routes->post('ruangan/edit-kategori-proc/(:num)', 'Admin\Ruangan::edit_proc/$1', ['as' => 'admin_edit_ruangan']);
    $routes->add('ruangan/switch-ruangan', 'Admin\Ruangan::konfirSwitch');
    $routes->add('ruangan/switch-ruangan-confirm/(:num)', 'Admin\Ruangan::flag_switch/$1', ['as' => 'admin_switch_ruangan']);
    
    $routes->post('ruangan/add-peminjaman', 'Admin\Ruangan::add_peminjaman_proc');
    $routes->add('ruangan/check', 'Admin\Ruangan::checkKeterangan');
    $routes->add('ruangan/switch-pinjaman', 'Admin\Ruangan::konfirSwitch2');
    $routes->add('ruangan/switch-approval-confirm/(:num)', 'Admin\Ruangan::flag_aktif/$1', ['as' => 'admin_switch_ruangan2']);
    $routes->add('ruangan/switch-pinjaman2', 'Admin\Ruangan::konfirSwitch3');
    $routes->add('ruangan/switch-decline-confirm/(:num)', 'Admin\Ruangan::flag_nonaktif/$1', ['as' => 'admin_switch_ruangan3']);
    
    $routes->post('akun/add-akun', 'Admin\Akun::add_proc');
    $routes->post('akun/edit-dosen-proc/(:num)', 'Admin\Akun::edit_proc/$1', ['as' => 'admin_edit_dosen']);

    $routes->add('akun/switch-akun', 'Admin\Akun::konfirSwitch');
    $routes->add('akun/edit-dosen', 'Admin\Akun::editDosen');
    $routes->add('ruangan/switch-decline-confirm/(:num)', 'Admin\Akun::hapus_akun/$1', ['as' => 'admin_switch_akun']);

});

$routes->group('dekan', static function ($routes)
{
    $routes->get('dashboard', 'Dekan\Dashboard::index');
    $routes->get('dokumen', 'Dekan\Dokumen::index');
    
    $routes->add('dokumen/(:num)', 'Dekan\Dokumen::detail/$1', ['as' => 'dekan_detail_dokumen']);
    $routes->add('dokumen/revisi/(:num)', 'Dekan\Dokumen::revisi_proc/$1', ['as' => 'dekan_pengajuan_revisi']);
    $routes->add('dokumen/acc/(:num)', 'Dekan\Dokumen::acc_proc/$1', ['as' => 'dekan_acc_dokumen']);
});

$routes->group('dosen', static function ($routes)
{
    $routes->get('dashboard', 'Dosen\Dashboard::index');
    $routes->get('dokumen', 'Dosen\Dokumen::index');
    $routes->get('ruangan', 'Dosen\Ruangan::index');
    $routes->get('dokumen-peminjaman', 'Dosen\Ruangan::dokumen_peminjaman');
    $routes->get('riwayat_peminjaman', 'Dosen\Ruangan::riwayat_peminjaman');
    $routes->get('check-ruangan', 'Dosen\Ruangan::checkRuangan');
    $routes->get('pengajuan', 'Dosen\Pengajuan::index');

    $routes->post('dokumen/add-req', 'Dosen\Dokumen::add_proc');
    $routes->post('dokumen/revisi-req', 'Dosen\Dokumen::revisi_proc');

    $routes->add('dokumen/detail-surat', 'Dosen\Dokumen::detail_surat');
    $routes->add('dokumen/revisi-update', 'Dosen\Dokumen::revisi_update');
    $routes->add('ruangan/check', 'Dosen\Ruangan::checkKeterangan');
    
    $routes->post('ruangan/add-peminjaman', 'Dosen\Ruangan::add_peminjaman_proc');
    $routes->add('ruangan/hapus-pinjaman', 'Dosen\Ruangan::deletePinjaman');
    $routes->add('ruangan/switch-approval-confirm/(:num)', 'Dosen\Ruangan::hapus_pinjaman/$1', ['as' => 'dosen_hapus_pinjaman']);
    
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
