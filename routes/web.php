<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductControll;
use App\Http\Controllers\ProductWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'Nama: Raditya Naila Sahwa Fahrezzy <br> NIM: 2455201005';
});

/*
|--------------------------------------------------------------------------
| Web UI - Blade (ProductWebController)
|--------------------------------------------------------------------------
*/
Route::resource('produk', ProductWebController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| API-style JSON routes (ProductControll)
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductControll::class)->except(['create', 'edit']);

Route::get('/categories', [CategoryController::class, 'index']);
