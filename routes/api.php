<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/clients', ClientController::class);
Route::resource('/transactions', TransactionController::class);

// Route::get('/products', [ProductController::class, 'index']);