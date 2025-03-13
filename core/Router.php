<?php

namespace Core;

class Router
{
    protected $routes = [];
    protected $middleware = [];

    // Method untuk menambahkan middleware ke route
    public function middleware($middleware, $routes)
    {
        foreach ($routes as $route) {
            $this->middleware[$route] = $middleware;
        }
    }

    // // Method untuk mengeksekusi middleware sebelum di update ke code baru
    // protected function runMiddleware($uri)
    // {
    //     if (isset($this->middleware[$uri])) {
    //         $middlewareClass = "Core\\Middleware\\{$this->middleware[$uri]}";
    //         $middleware = new $middlewareClass();
    //         $middleware->handle();
    //     }
    // }

    // Method untuk mengeksekusi middleware setelah di update ke code baru
    protected function runMiddleware($uri)
    {
        foreach ($this->middleware as $routePattern => $middlewareClass) {
            // Ganti {id} dengan regex untuk mencocokkan parameter dinamis
            $routePattern = preg_replace('/\{([a-z]+)\}/', '([^\/]+)', $routePattern);

            // Cocokkan URI dengan pola route
            if (preg_match("#^$routePattern$#", $uri)) {
                $middleware = "Core\\Middleware\\{$middlewareClass}";
                $middlewareInstance = new $middleware();
                $middlewareInstance->handle();
            }
        }
    }

    // Method untuk menambahkan route GET
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    // Method untuk menambahkan route POST
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    // // Method untuk dispatch route sebelum di perbaiki
    // public function dispatch($uri, $method)
    // {
    //     $this->runMiddleware($uri); // Jalankan middleware sebelum dispatch
    //     if (array_key_exists($uri, $this->routes[$method])) {
    //         $this->callAction(...explode('@', $this->routes[$method][$uri]));
    //     } else {
    //         throw new \Exception("Route not found.");
    //     }
    // }

    // Method untuk dispatch route setelah di perbaiki
    public function dispatch($uri, $method)
    {
        $this->runMiddleware($uri); // Jalankan middleware sebelum dispatch

        foreach ($this->routes[$method] as $route => $controllerAction) {
            // Ganti {id} dengan regex untuk mencocokkan parameter dinamis
            $routePattern = preg_replace('/\{([a-z]+)\}/', '([^\/]+)', $route);

            // Cocokkan URI dengan pola route
            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                // Hapus elemen pertama (full match) dari array $matches
                array_shift($matches);

                // Pisahkan controller dan method
                list($controller, $action) = explode('@', $controllerAction);

                // Buat instance controller dan panggil method
                $controller = "App\\Controllers\\{$controller}";
                $controller = new $controller;

                // Periksa apakah method ada di controller
                if (!method_exists($controller, $action)) {
                    throw new \Exception("{$controller} does not respond to the {$action} action.");
                }

                // Panggil method dengan parameter
                return call_user_func_array([$controller, $action], $matches);
            }
        }

        throw new \Exception("Route not found.");
    }

    // // Method untuk memanggil action di controller
    // protected function callAction($controller, $action)
    // {
    //     $controller = "App\\Controllers\\{$controller}";
    //     $controller = new $controller;

    //     if (!method_exists($controller, $action)) {
    //         throw new \Exception("{$controller} does not respond to the {$action} action.");
    //     }

    //     return $controller->$action();
    // }
}
