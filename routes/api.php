<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/products', ProductController::class);
Route::get('/products-search', [ProductController::class,'searchProduct']);
Route::get('/charts', [ProductTransactionController::class,'getChartsData']);
Route::get('/todays_sale', [TransactionController::class,'getTodaysSale']);
Route::get('/search_sales', [TransactionController::class,'getSearchSales']);
Route::get('/transactions-search', [TransactionController::class,'searchTransacntion']);
Route::post('/transactions/reciept_pdf', [TransactionController::class,'gerenatePdf']);
Route::post('/transactions/reciept_print', [TransactionController::class,'gerenatePrint']);
Route::resource('/categories', CategoryController::class);
Route::resource('/clients', ClientController::class);
Route::resource('/transactions', TransactionController::class);

// Route::get('/products', [ProductController::class, 'index']);
