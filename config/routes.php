<?php

use App\Core\Request;
use App\Core\Route;


$request = new Request();
$route   = new Route($request);
try {
    $route->add('/', 'App\Controllers\HomeController@index');
    $route->add('/login', 'App\Controllers\AuthController@getLogin');
    $route->add('/post-login', 'App\Controllers\AuthController@postLogin');
    $route->add('/register', 'App\Controllers\AuthController@getLogin');
    $route->add('/logot', 'App\Controllers\AuthController@getLogot');
    $route->add('/shop', 'App\Controllers\ProductController@index');
    $route->add('/cart', 'App\Controllers\CartController@index');
    $route->add('/details/{prodId}', 'App\Controllers\ProductController@showDetails');
    $route->submit();
} catch (Exception $e) {
    echo "404";
}
