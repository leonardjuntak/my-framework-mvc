<?php

/** 
 * Import Class yang dibutuhkan.
 */

use Core\Router;

/* Inisiasi Router */

$router = new Router();

/** 
 * Router List
 * ['/####'] adalah routenya, dan ['####@###'] adalah controller dan methodnya. 
 * Contoh =>  $router->get('/login', 'AuthController@showLoginForm');
 * $router->get(); adalah router dengan metode pengiriman data get.
 * $router->post(); adalah router dengan metode pengiriman data post.
 * '/login' => adalah route tujuannya kemana.
 * 'AuthController@showLoginForm' => adalah mengakses AuthController dengan metod showLoginForm. 
 */

/**Route List */

/* Login */
$router->get('/login', 'AuthController@showLoginForm');
$router->post('/login', 'AuthController@login');

/* Logout */
$router->get('/logout', 'AuthController@logout');

/* Home dan about*/
$router->get('/', 'DashboardController@home');
$router->get('/home', 'DashboardController@home');
$router->get('/about', 'DashboardController@about');

/* Dashboard */
$router->get('/dashboard', 'DashboardController@index');

/* Products */
$router->get('/products', 'ProductController@index');
$router->get('/products/create', 'ProductController@create');
$router->post('/products/store', 'ProductController@store');
$router->get('/products/edit/{id}', 'ProductController@edit');
$router->post('/products/update/{id}', 'ProductController@update');
$router->post('/products/delete/{id}', 'ProductController@delete');
$router->get('/products/export-pdf', 'ProductController@exportPdf');

/*admin/users  */
$router->get('/admin/users', 'UserController@index');
$router->get('/admin/users/create', 'UserController@create');
$router->post('/admin/users/store', 'UserController@store');
$router->get('/admin/users/edit/{id}', 'UserController@edit');
$router->post('/admin/users/update/{id}', 'UserController@update');
$router->post('/admin/users/delete/{id}', 'UserController@delete');
$router->get('/admin/users/export-pdf', 'UserController@exportPdf');

/**Middleware */

/**
 * GuestMiddleware
 * Untuk memastikan hanya user yang belum login yang bisa mengakses route tsb.
 */

$router->middleware(
    /**Nama Middleware */
    'GuestMiddleware',
    [
        /**List Route yang di lindungi oleh Middleware */
        '/login'
    ]
);

/**
 * AuthMiddleware 
 * Untuk mengetahui Apakah si pengguna sudah login?
 * Hanya pengguna yang sudah login yang bisa mengakses route tersebut.
 */
$router->middleware(
    /**Nama Middleware */
    'AuthMiddleware',
    [
        /**List Route dashboard yang di lindungi oleh Middleware */
        '/',
        '/dashboard',

        /**List Route Products yang di lindungi oleh Middleware */
        '/products',
        '/products/create',
        '/products/store',
        '/products/edit/{id}',
        '/products/update/{id}',
        '/products/delete/{id}',
        '/products/export-pdf',

        /**List Route Kelola User (Admin/Users) yang di lindungi oleh Middleware */
        '/admin/users/create',
        '/admin/users/store',
        '/admin/users/edit/{id}',
        '/admin/users/update/{id}',
        '/admin/users/delete/{id}',
        '/admin/users/export-pdf',
    ]
);

/**
 * AdminMiddleware 
 * Untuk memberikan tanda hanya role admin yang dapat mengakses ke route tersebut.
 */
$router->middleware(
    /** Nama Middleware*/
    'AdminMiddleware',
    [
        /**List Route Products yang di lindungi oleh Middleware */
        '/products/create',
        '/products/store',
        '/products/edit/{id}',
        '/products/update/{id}',
        '/products/delete/{id}',
        '/products/export-pdf',

        /**List Route Kelola User (Admin/Users) yang di lindungi oleh Middleware */
        '/admin/users/create',
        '/admin/users/store',
        '/admin/users/edit/{id}',
        '/admin/users/update/{id}',
        '/admin/users/delete/{id}',
        '/admin/users/export-pdf',
    ]
);
