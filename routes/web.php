<?php

use Illuminate\Support\Facades\Route;

/*ROUTE */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);





/*admin route*/
Route::get('/admin', [App\Http\Controllers\admin\AdminController::class, 'index']);