<?php
use Illuminate\Support\Facades\Route;
/*ROUTE */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
/*base admin route*/
Route::get('/admin', [App\Http\Controllers\admin\AdminController::class, 'index']);

Route::get('/adm/produk-index', [App\Http\Controllers\admin\ProdukController::class, 'index']);
Route::get('/adm/produk-index/create', [App\Http\Controllers\admin\ProdukController::class, 'create']);