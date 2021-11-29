<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
// use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Client\OrderController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
  ], function(){ 
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
           Route::get('/index', [DashboardController::class, 'index'])->name('index');
           // user route
           Route::resource('user', UserController::class);

           //product route
           Route::resource('product', ProductController::class);

           //catigory route
           Route::resource('catigory', CatigoryController::class);

           //client routes
           Route::resource('client', ClientController::class);
           Route::resource('client.order', OrderController::class);

           //order route
           Route::resource('order', DashboardOrderController::class);
           Route::get('/order/{order}/products', [DashboardOrderController::class, 'products'])->name('order.product');
       });

  });


?>