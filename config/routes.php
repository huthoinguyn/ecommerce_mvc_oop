<?php

use App\Controllers\AdminController;
use App\Core\Request;
use App\Core\Route;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\CartController;
use App\Controllers\PostController;
use App\Controllers\ProductController;

$request = new Request();
// try {

Route::get('/', HomeController::class . '@index');
Route::get('/notfound', HomeController::class . '@notFound');


Route::get('/login', AuthController::class . '@getLogin');
Route::post('/login', AuthController::class . '@postLogin');
Route::get('/logout', AuthController::class . '@getLogout');
Route::post('/login', AuthController::class . '@postLogin');
Route::get('/register', AuthController::class . '@getRegister');
Route::post('/register', AuthController::class . '@postRegister');

Route::get('/about', AboutController::class . '@viewAbout');

Route::get('/shop', ProductController::class . '@index');
Route::get('/prodselectbycat/{id}', ProductController::class . '@prodSelectByCat');
Route::get('/prodselectbybrand/{id}', ProductController::class . '@prodSelectByBrand');
Route::get('/admin/prod', ProductController::class . '@getProd');
Route::get('/admin/addprod', ProductController::class . '@addProd');
Route::post('/admin/addprod', ProductController::class . '@postProd');
Route::get('/admin/deleteprod/{id}', ProductController::class . '@deleteProd');
Route::get('/admin/updateprod/{id}', ProductController::class . '@updateProd');
Route::post('/admin/updateprod', ProductController::class . '@postUpdateProd');

Route::get('/cart', CartController::class . '@index');
Route::post('/addtocart', CartController::class . '@addToCart');
Route::post('/updatecart', CartController::class . '@updateCart');
Route::get('/deletecart/{id}', CartController::class . '@delCart');

Route::get('/admin', AdminController::class . '@index');
Route::get('/admin/cat', AdminController::class . '@getCat');
Route::post('/admin/cat', AdminController::class . '@postCat');
Route::get('/admin/updatecat/{id}', AdminController::class . '@updateCat');
Route::post('/admin/updatecat', AdminController::class . '@postUpdateCat');
Route::get('/admin/deletecat/{id}', AdminController::class . '@deleteCat');
Route::get('/admin/brand', AdminController::class . '@getBrand');
Route::post('/admin/brand', AdminController::class . '@postBrand');
Route::get('/admin/updatebrand/{id}', AdminController::class . '@updateBrand');
Route::post('/admin/updatebrand', AdminController::class . '@postUpdateBrand');
Route::get('/admin/deletebrand/{id}', AdminController::class . '@deleteBrand');


Route::get('/details/{id}', ProductController::class . '@showDetails');


Route::resolve();
// } catch (Exception $e) {
//     header('Location: /notfound');
// }
