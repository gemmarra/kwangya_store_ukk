<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::login');
$routes->post('/auth', 'User::auth');
//$routes->post('/auth', 'User::auth');
$routes->get('/logout', 'User::logout');
$routes->get('/register', 'Home::register');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/report', 'Report::index');
$routes->get('/coba1', 'Home::coba1');
$routes->get('/coba2', 'Home::coba2');

// User
$routes->get('/user/select', 'User::index');
$routes->post('/user/search', 'User::index');
$routes->get('/user/insert', 'User::insert');
$routes->post('/user/save', 'User::save');
$routes->get('/user/delete/(:any)', 'User::delete/$1');
$routes->get('/user/edit/(:any)', 'User::edit/$1');
$routes->post('/user/update/(:any)', 'User::update/$1');
$routes->get('/user/edit_password/(:any)', 'User::edit_password/$1');
$routes->post('/user/update_password/(:any)', 'User::update_password/$1');
// $routes->post('/user/search', 'User::search');

// Selling
$routes->get('/selling/select', 'Selling::index');
$routes->get('/selling/cashier_machine', 'Selling::cashiermachine');
$routes->post('/selling/search', 'Selling::cashiermachine');
$routes->get('/selling/today_income', 'Selling::today_income');
$routes->post('/selling/insert_total', 'Selling::insert_total');
$routes->post('/selling/save', 'Selling::save');
$routes->get('/selling/payment', 'Selling::payment');
$routes->get('/selling/pdf', 'Selling::pdf');
$routes->get('/selling/pdfgenerate', 'Selling::pdfgenerate');


// Product
$routes->get('/product/select', 'Product::index');
// $routes->post('/product/select', 'Product::index');
$routes->get('/product/insert', 'Product::insert');
$routes->post('/product/save', 'Product::save');
$routes->get('/product/delete/(:num)', 'Product::delete/$1');
$routes->get('/product/edit/(:num)', 'Product::edit/$1');
$routes->post('/product/update/(:num)', 'Product::update/$1');
$routes->post('/product/search_name', 'Product::index');
$routes->get('/product/pdf', 'Product::pdf');
$routes->get('/product/pdfgenerate', 'Product::pdfgenerate');

//Selling Details
$routes->get('/sellingdetails/select/(:any)', 'SellingDetails::index/$1');
$routes->post('/sellingdetails/save', 'SellingDetails::save');
$routes->get('/sellingdetails/grand_total', 'SellingDetails::grand_total');

// category
$routes->get('/category/select', 'Category::index');
$routes->post('/category/search', 'Category::index');
$routes->get('/category/insert', 'Category::insert');
$routes->post('/category/save', 'Category::save');
$routes->get('/category/delete/(:num)', 'Category::delete/$1');
$routes->get('/category/edit/(:num)', 'Category::edit/$1');
$routes->post('/category/update/(:num)', 'Category::update/$1');

// Denomination
$routes->get('/denomination/select', 'Denomination::index');
$routes->post('/denomination/search', 'Denomination::index');
$routes->get('/denomination/insert', 'Denomination::insert');
$routes->post('/denomination/save', 'Denomination::save');
$routes->get('/denomination/delete/(:num)', 'Denomination::delete/$1');
$routes->get('/denomination/edit/(:num)', 'Denomination::edit/$1');
$routes->post('/denomination/update/(:num)', 'Denomination::update/$1');

// Purchase
$routes->get('/purchase/select', 'Purchase::index');
$routes->post('/purchase/search', 'Purchase::index');
$routes->get('/purchase/insert', 'Purchase::insert');
$routes->post('/purchase/save', 'Purchase::save');
$routes->get('/purchase/delete/(:num)', 'Purchase::delete/$1');
$routes->get('/purchase/edit/(:num)', 'Purchase::edit/$1');
$routes->post('/purchase/update/(:num)', 'Purchase::update/$1');
