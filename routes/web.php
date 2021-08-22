<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;

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
