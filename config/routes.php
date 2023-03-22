<?php

use App\Core\Request;
use App\Core\Route;


$request = new Request();
$route   = new Route($request);
try {
    $route->add('/', 'App\Controllers\HomeController@index');
    $route->add('/notfound', 'App\Controllers\HomeController@notFound');
    $route->add('/login', 'App\Controllers\AuthController@getLogin');
    $route->add('/post-login', 'App\Controllers\AuthController@postLogin');
    $route->add('/register', 'App\Controllers\AuthController@getLogin');
    $route->add('/logout', 'App\Controllers\AuthController@getLogout');
    $route->add('/shop', 'App\Controllers\ProductController@index');
    $route->add('/cart', 'App\Controllers\CartController@index');
    $route->add('/admin', 'App\Controllers\AdminController@index');
    $route->add('/admin', 'App\Controllers\AdminController@index');
    $route->add('/admin/cat', 'App\Controllers\AdminController@getCat');
    $route->add('/admin/brand', 'App\Controllers\AdminController@getBrand');
    $route->add('/admin/prod', 'App\Controllers\AdminController@getProd');
    $route->add('/details/{prodId}', 'App\Controllers\ProductController@showDetails');
    $route->submit();
} catch (Exception $e) {
    header('Location: /notfound');
}
