<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:sanctum'] ], function () {

});
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::resource('/products', ProductController::class);
Route::post('/barcode', [ProductController::class,'generateBarcode']);
Route::get('/products-search', [ProductController::class,'searchProduct']);
Route::get('/products-find', [ProductController::class,'searchBarcode']);
Route::get('/products-featured', [ProductController::class,'getFeaturedProducts']);
Route::get('/assets', [ProductController::class,'getAllAssets']);
Route::get('/assets-sales', [ProductTransactionController::class,'getAllAssetsSales']);
Route::get('/bars', [TransactionController::class,'getbarsData']);
Route::get('/charts', [ProductTransactionController::class,'getChartsData']);
Route::get('/todays_sale', [TransactionController::class,'getTodaysSale']);
Route::get('/search_sales', [TransactionController::class,'getSearchSales']);
Route::get('/search_expenses', [ExpenseController::class,'getSearchExpenses']);
Route::get('/search_assets_sales', [ProductTransactionController::class,'getSearchAssetsSales']);
Route::get('/transactions-search', [TransactionController::class,'searchTransacntion']);
Route::post('/transactions/reciept_pdf', [TransactionController::class,'gerenatePdf']);
Route::post('/transactions/reciept_print', [TransactionController::class,'gerenatePrint']);
Route::post('/transactions/sales_print', [TransactionController::class,'gerenateSalesPrint']);
Route::post('/expenses/expenses_print', [ExpenseController::class,'gerenateExpensesPrint']);
Route::post('/print_assets_report', [ProductController::class,'gerenateAssetsPrint']);
Route::post('/print_assets_sales', [ProductController::class,'gerenateAssetsSalesPrint']);
Route::resource('/categories', CategoryController::class);
Route::resource('/clients', ClientController::class);
Route::resource('/transactions', TransactionController::class);
Route::resource('/expenses', ExpenseController::class);
Route::resource('/sizes', SizeController::class);
Route::resource('/colors', ColorController::class);
Route::resource('/users', UserController::class);

// Route::get('/products', [ProductController::class, 'index']);
