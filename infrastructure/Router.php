<?php

namespace Infrastructure;

use App\Controllers\HomeController;

class Router
{
    protected $routes = [
        '/'       => [HomeController::class, 'index'],
    ];

    public function handle()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$path])) {
            [$controller, $method] = $this->routes[$path];
            (new $controller())->$method();
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }
}
