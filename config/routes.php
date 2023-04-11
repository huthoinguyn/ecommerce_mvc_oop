<?php

use App\Controllers\AdminController;
use App\Core\Request;
use App\Core\Route;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\PostController;
use App\Controllers\ProductController;
use App\Controllers\VariantController;

$request = new Request();
// try {

    Route::get('/', 'App\Controllers\HomeController@index');
    Route::get('/notfound', 'App\Controllers\HomeController@notFound');


    Route::get('/login', 'App\Controllers\AuthController@getLogin');
    Route::post('/login', 'App\Controllers\AuthController@postLogin');
    Route::get('/logout', 'App\Controllers\AuthController@getLogout');
    Route::get('/register', 'App\Controllers\AuthController@getRegister');
    Route::post('/register', 'App\Controllers\AuthController@postRegister');

    Route::get('/about', 'App\Controllers\AboutController@viewAbout');

    Route::get('/get_prod_api', 'App\Controllers\ProductController@getAllProd');


    Route::get('/shop', 'App\Controllers\ProductController@index');
    Route::get('/prodselectbycat{id}', 'App\Controllers\ProductController@prodSelectByCat');
    Route::get('/prodselectbybrand{id}', 'App\Controllers\ProductController@prodSelectByBrand');
    Route::get('/admin/prod', 'App\Controllers\ProductController@getProd');
    Route::get('/admin/addprod', 'App\Controllers\ProductController@addProd');
    Route::post('/admin/addprod', 'App\Controllers\ProductController@postProd');
    Route::get('/admin/deleteprod{id}', 'App\Controllers\ProductController@deleteProd');
    Route::get('/admin/updateprod{id}', 'App\Controllers\ProductController@updateProd');
    Route::post('/admin/updateprod', 'App\Controllers\ProductController@postUpdateProd');

    Route::get('/cart', 'App\Controllers\CartController@index');
    Route::post('/addtocart', 'App\Controllers\CartController@addToCart');
    Route::post('/updatecart', 'App\Controllers\CartController@updateCart');
    Route::get('/deletecart{id}', 'App\Controllers\CartController@delCart');

    Route::get('/admin', 'App\Controllers\AdminController@index');
    Route::get('/admin/cat', 'App\Controllers\AdminController@getCat');
    Route::post('/admin/cat', 'App\Controllers\AdminController@postCat');
    Route::get('/admin/updatecat{id}', 'App\Controllers\AdminController@updateCat');
    Route::post('/admin/updatecat', 'App\Controllers\AdminController@postUpdateCat');
    Route::get('/admin/deletecat{id}', 'App\Controllers\AdminController@deleteCat');
    Route::get('/admin/brand', 'App\Controllers\AdminController@getBrand');
    Route::post('/admin/brand', 'App\Controllers\AdminController@postBrand');
    Route::get('/admin/updatebrand{id}', 'App\Controllers\AdminController@updateBrand');
    Route::post('/admin/updatebrand', 'App\Controllers\AdminController@postUpdateBrand');
    Route::get('/admin/deletebrand{id}', 'App\Controllers\AdminController@deleteBrand');


    Route::get('/details{id}', 'App\Controllers\VariantController@showDetails');
    Route::get('/color_variant{id}', 'App\Controllers\VariantController@getColorVariant');
    
    Route::get('/checkout', 'App\Controllers\CheckoutController@index');
    Route::post('/order/momo', 'App\Controllers\Checkout\QRMomo@checkOut');
    Route::post('/order/vnpay', 'App\Controllers\Checkout\VNPay@checkOut');



    Route::resolve();
// } catch (Exception $e) {
//     header('Location: /notfound');
// }
