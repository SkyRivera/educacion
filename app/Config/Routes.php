<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Contenidos::index');
$routes->get('contenidos/admin', 'Contenidos::admin');
$routes->get('contenidos/create', 'Contenidos::create');
$routes->post('contenidos/store', 'Contenidos::store');
$routes->get('contenidos/edit/(:segment)', 'Contenidos::edit/$1');
$routes->post('contenidos/update/(:segment)', 'Contenidos::update/$1');
$routes->get('contenidos/delete/(:segment)', 'Contenidos::delete/$1');
$routes->get('contenidos/(:segment)', 'Contenidos::show/$1');
$routes->get('juego', 'Juego::index');
$routes->get('juego/nivel/(:num)', 'Juego::nivel/$1');

$routes->get('api/listaContenidosPortada', 'Contenidos::listaContenidosPortada');
$routes->get('api/listaContenidos', 'Contenidos::listaContenidos');
$routes->get('api/verContenido/(:segment)', 'Contenidos::verContenido/$1');
$routes->post('api/nuevoContenido', 'Contenidos::nuevoContenido');
$routes->post('api/actualizarContenido/(:segment)', 'Contenidos::actualizarContenido/$1');

$routes->get('public/uploads/(:alpha)', 'Juego::billete/$1');