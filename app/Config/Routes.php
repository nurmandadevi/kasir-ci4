<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/produk', 'Produk::index');
$routes->get('/', 'Home::index');
$routes->get('Poin', 'Poin::index');
$routes->get('Hadiah', 'Hadiah::index'); // controller baru
