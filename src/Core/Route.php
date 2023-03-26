<?php

namespace App\Core;

class Route
{
    private static $routes = [];

    public static function get($pattern, $controllerMethod)
    {
        self::$routes[] = ['GET', $pattern, $controllerMethod];
    }

    public static function post($pattern, $controllerMethod)
    {
        self::$routes[] = ['POST', $pattern, $controllerMethod];
    }

    public static function resolve()
    {
        $path   = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            [$routeMethod, $pattern, $controllerMethod] = $route;

            $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
            $pattern = str_replace('{id}', '(?P<id>\d+)', $pattern);
            if ($method !== $routeMethod) {
                continue;
            }

            if (!preg_match($pattern, $path, $params)) {
                continue;
            }
            $params                     = array_slice($params, 1);
            [$controllerClass, $method] = explode('@', $controllerMethod);

            $controller = new $controllerClass();
            $controller->$method($params);
            return;
        }

        http_response_code(404);
        header('Location: /notfound');
    }
}
