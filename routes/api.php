<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/products', [ProductController::class, 'index']);
Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/clients', ClientController::class);