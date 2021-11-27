<?php

use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\Dashboard\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
// use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
  ], function(){ 
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
           Route::get('/index', [DashboardController::class, 'index'])->name('index');
           Route::resource('user', UserController::class);
           Route::resource('product', ProductController::class);
           Route::resource('catigory', CatigoryController::class);
           Route::resource('client', ClientController::class);
           Route::resource('order', OrderController::class);
       });

  });


?>