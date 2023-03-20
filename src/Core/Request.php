<?php

namespace App\Core;

/**
 * Summary of Request
 */
class Request
{
    private $method;
    private $pathInfo;
    private $queryString;
    private $params;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->method      = $_SERVER['REQUEST_METHOD'];
        $this->pathInfo    = $_SERVER['REQUEST_URI'] ?? '/';
        $this->queryString = $_SERVER['QUERY_STRING'] ?? '';
        $this->params      = array_merge($_GET, $_POST);
    }

    /**
     * Summary of getMethod
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Summary of getPathInfo
     * @return mixed
     */
    public function getPathInfo()
    {
        return $this->pathInfo;
    }

    /**
     * Summary of getQueryString
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Summary of getParam
     * @param mixed $name
     * @return mixed
     */
    public function getParam($name)
    {
        return $this->params[$name] ?? null;
    }
}