<?php

use Illuminate\Support\Facades\Route;

/*ROUTE */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);