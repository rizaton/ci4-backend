<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group(
    'api',
    [
        'filter' => 'cors:api'
    ],
    static function (RouteCollection $routes): void {
        $routes->resource('user');
        $routes->options('user', static function () {
            $response = response();
            $response->setStatusCode(204);
            $response->setHeader('Access-Control-Allow-Origin', '*');
            $response->setHeader('Allow:', 'GET, POST, PUT, DELETE, OPTIONS');
            return $response;
        });
        $routes->options('user/(:any)', static function () {});
    }
);
