<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function add($method, $path, $controller) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller
        ];
    }

    public function get($path, $controller) {
        $this->add('GET', $path, $controller);
    }

    public function post($path, $controller) {
        $this->add('POST', $path, $controller);
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['path'] === $uri && $route['method'] === $method) {
                [$controller, $action] = explode('@', $route['controller']);
                $controller = "App\\Controllers\\Front\\{$controller}";
                $instance = new $controller();
                $instance->$action();
                return;
            }
        }

        // 404 handling
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}
