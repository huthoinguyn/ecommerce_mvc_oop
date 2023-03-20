<?php

namespace App\Core;

use Exception;

class Route
{

    const _msg_ctrl = "Không tìm thấy controller";

    const _msg_route = "Không tìm thấy route";

    private $routes = [];
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function add($route, $controller)
    {
        $this->routes[$route] = $controller;
    }

    public function submit()
    {
        $uri = $this->request->getPathInfo();

        foreach ($this->routes as $route => $controller) {

            if (strcmp($uri, $route) === 0) {
                $parts      = explode('@', $controller);
                $className  = $parts[0];
                $methodName = $parts[1];
                if (class_exists($className)) {
                    // $controller = new $className();
                    // $controller->{$this->request->getMethod()}();
                    $class = new $className();
                    call_user_func_array(array($class, $methodName), array());
                    return;
                } else {
                    throw new Exception(self::_msg_ctrl);
                }

            }
        }
        throw new Exception(self::_msg_route);
    }

}