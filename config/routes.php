<?php

use App\Core\Request;
use App\Core\Route;


$request = new Request();
$route   = new Route($request);
try {
    $route->add('/', 'App\Controllers\HomeController@index');
    $route->add('/login', 'App\Controllers\AuthController@getLogin');
    $route->add('/logot', 'App\Controllers\AuthController@getLogot');
    $route->submit();
} catch (Exception $e) {
    echo "Trang không tồn tại";
}