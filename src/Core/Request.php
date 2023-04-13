<?php

namespace App\Core;

class Request
{
    public function getParam($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function getQueryParams()
    {
        return $_GET;
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath()
    {
        $path     = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }
}
