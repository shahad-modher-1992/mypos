<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatigoryController;
use App\Http\Controllers\Api\ProductController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('user', AuthController::class);
Route::resource('catigory', CatigoryController::class);
Route::get('login', [AuthController::class, 'login']);
Route::post('setpermissions', [AuthController::class, 'setPermissions']);
Route::get('search', [AuthController::class, 'search']);
Route::resource('product', ProductController::class);
Route::get('getproducbycat/{id}', [ProductController::class, 'getProductByCatId']);



