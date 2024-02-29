<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::login');
$routes->post('/dashboard', 'Home::dashboard',['filter'=>'autentifikasi']);

$routes->get('/login', 'User::login');
$routes->post('/login', 'User::login');
$routes->get('/dashboard', 'Home::dashboard',['filter'=>'autentifikasi']);
$routes->get('/logout', 'User::logout');

//$routes->post('/auth', 'User::auth');
// $routes->get('/logout', 'User::logout');
// $routes->get('/register', 'Home::register');
// $routes->get('/dashboard', 'Home::dashboard');
$routes->get('/coba1', 'Home::coba1');
$routes->get('/coba2', 'Home::coba2');

// User
$routes->get('/user/select', 'User::index',['filter'=>'autentifikasi']);
$routes->post('/user/search', 'User::index',['filter'=>'autentifikasi']);
$routes->get('/user/insert', 'User::insert',['filter'=>'autentifikasi']);
$routes->post('/user/save', 'User::save',['filter'=>'autentifikasi']);
$routes->get('/user/delete/(:any)', 'User::delete/$1',['filter'=>'autentifikasi']);
$routes->get('/user/edit/(:any)', 'User::edit/$1',['filter'=>'autentifikasi']);
$routes->post('/user/update/(:any)', 'User::update/$1',['filter'=>'autentifikasi']);
$routes->get('/user/edit_password/(:any)', 'User::edit_password/$1',['filter'=>'autentifikasi']);
$routes->post('/user/update_password/(:any)', 'User::update_password/$1',['filter'=>'autentifikasi']);
// $routes->post('/user/search', 'User::search');

// Selling
$routes->get('/selling/select', 'Selling::index', ['filter'=>'autentifikasi']);
$routes->get('/selling/cashier_machine', 'Selling::cashiermachine', ['filter'=>'autentifikasi']);
// $routes->post('/selling/search', 'Selling::cashiermachine', ['filter'=>'autentifikasi']);
$routes->get('/selling/today_income', 'Selling::today_income', ['filter'=>'autentifikasi']);
$routes->post('/selling/insert_total', 'Selling::insert_total', ['filter'=>'autentifikasi']);
$routes->post('/selling/save', 'Selling::save', ['filter'=>'autentifikasi']);
$routes->get('/selling/payment', 'Selling::payment', ['filter'=>'autentifikasi']);
$routes->get('/selling/pdf', 'Selling::pdf', ['filter'=>'autentifikasi']);
$routes->get('/selling/pdfgenerate', 'Selling::pdfgenerate', ['filter'=>'autentifikasi']);


// Product
$routes->get('/product/select', 'Product::index', ['filter'=>'autentifikasi']);
// $routes->post('/product/select', 'Product::index');
$routes->get('/product/insert', 'Product::insert', ['filter'=>'autentifikasi']);
$routes->post('/product/save', 'Product::save', ['filter'=>'autentifikasi']);
$routes->get('/product/delete/(:num)', 'Product::delete/$1', ['filter'=>'autentifikasi']);
$routes->get('/product/edit/(:num)', 'Product::edit/$1', ['filter'=>'autentifikasi']);
$routes->post('/product/update/(:num)', 'Product::update/$1', ['filter'=>'autentifikasi']);
$routes->post('/product/search_name', 'Product::index', ['filter'=>'autentifikasi']);
$routes->get('/product/pdf', 'Product::pdf', ['filter'=>'autentifikasi']);
$routes->get('/product/pdfgenerate', 'Product::pdfgenerate', ['filter'=>'autentifikasi']);

//Selling Details
$routes->get('/sellingdetails/select/(:any)', 'SellingDetails::index/$1', ['filter'=>'autentifikasi']);
$routes->post('/sellingdetails/save', 'SellingDetails::save', ['filter'=>'autentifikasi']);
$routes->get('/sellingdetails/grand_total', 'SellingDetails::grand_total', ['filter'=>'autentifikasi']);

// category
$routes->get('/category/select', 'Category::index', ['filter'=>'autentifikasi']);
$routes->post('/category/search', 'Category::index', ['filter'=>'autentifikasi']);
$routes->get('/category/insert', 'Category::insert', ['filter'=>'autentifikasi']);
$routes->post('/category/save', 'Category::save', ['filter'=>'autentifikasi']);
$routes->get('/category/delete/(:num)', 'Category::delete/$1', ['filter'=>'autentifikasi']);
$routes->get('/category/edit/(:num)', 'Category::edit/$1', ['filter'=>'autentifikasi']);
$routes->post('/category/update/(:num)', 'Category::update/$1', ['filter'=>'autentifikasi']);

// Denomination
$routes->get('/denomination/select', 'Denomination::index', ['filter'=>'autentifikasi']);
$routes->post('/denomination/search', 'Denomination::index', ['filter'=>'autentifikasi']);
$routes->get('/denomination/insert', 'Denomination::insert', ['filter'=>'autentifikasi']);
$routes->post('/denomination/save', 'Denomination::save', ['filter'=>'autentifikasi']);
$routes->get('/denomination/delete/(:num)', 'Denomination::delete/$1', ['filter'=>'autentifikasi']);
$routes->get('/denomination/edit/(:num)', 'Denomination::edit/$1', ['filter'=>'autentifikasi']);
$routes->post('/denomination/update/(:num)', 'Denomination::update/$1', ['filter'=>'autentifikasi']);

// Purchase
$routes->get('/purchase/select', 'Purchase::index', ['filter'=>'autentifikasi']);
$routes->post('/purchase/search', 'Purchase::index', ['filter'=>'autentifikasi']);
$routes->get('/purchase/insert', 'Purchase::insert', ['filter'=>'autentifikasi']);
$routes->post('/purchase/save', 'Purchase::save', ['filter'=>'autentifikasi']);
$routes->get('/purchase/delete/(:num)', 'Purchase::delete/$1 ', ['filter'=>'autentifikasi']);
$routes->get('/purchase/edit/(:num)', 'Purchase::edit/$1     ', ['filter'=>'autentifikasi']);
$routes->post('/purchase/update/(:num)', 'Purchase::update/$1', ['filter'=>'autentifikasi']);

// Report
$routes->get('/report', 'Report::index',['filter'=>'autentifikasi']);
$routes->get('/report_result', 'Report::index',['filter'=>'autentifikasi']);
$routes->post('/reportgenerate', 'Report::generate_report', ['filter'=>'autentifikasi']);
