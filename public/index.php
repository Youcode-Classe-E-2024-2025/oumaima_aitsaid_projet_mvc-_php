<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

// Define routes
$router->get('/', 'HomeController@index');
$router->get('/cakes', 'CakeController@index');
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/catalogue', 'CatalogController@index');
$router->get('/categorie/{id}', 'CatalogController@category');$router->dispatch();
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
// Update these routes
$router->get('/inscription', 'AuthController@registerForm');
$router->post('/inscription', 'AuthController@register');
