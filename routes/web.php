<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\SalesController;

use App\RPrinter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'dashboard');

Route::get('/item', [ItemController::class, 'index']);
Route::post('/item', [ItemController::class, 'add']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'add']);
Route::get('/pos', [POSController::class, 'demoPos'] );
Route::get('/pos-dev', [POSController::class, 'index'] );
Route::post('/order', [POSController::class, 'processOrder']);
Route::get('/print', [RPrinter::class, 'print' ]);
Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales/cancel', [SalesController::class, 'cancelSale']);
Route::get('/sales/products', [SalesController::class, 'products']);

Route::post('/sales/cancel/undo', [SalesController::class, 'undoCancelSale']);
Route::get('/products/items', [ProductController::class, 'getItems']);
