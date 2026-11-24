<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductControll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/about', function () {
    return 'Nama: Raditya Naila Sahwa Fahrezzy <br> NIM: 2455201005';
});

Route::resource('products', ProductControll::class)->except(['create', 'edit']);

Route::get('/categories', [CategoryController::class, 'index']);
