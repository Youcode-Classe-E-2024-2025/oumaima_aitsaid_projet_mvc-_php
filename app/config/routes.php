<?php
use App\Controllers\Front\HomeController;
use App\Controllers\Front\CakeController;
use App\Controllers\Front\AuthController;

$router->get('/', HomeController::class, 'index');
$router->get('catalogue', CakeController::class, 'index');
$router->get('cake/{id}', CakeController::class, 'show');
$router->get('login', AuthController::class, 'loginForm');
$router->post('login', AuthController::class, 'login');
