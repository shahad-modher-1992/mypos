<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;




Route::prefix('dashboard')->name('dashboard.')->group(function() {
   Route::get('/index', [DashboardController::class, 'index'])->name('index');
});

?>