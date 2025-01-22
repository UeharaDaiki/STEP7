<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/productList', [App\Http\Controllers\ProductListController::class, 'index'])->name('productList');
Route::post('/product/delete/{id}', [App\Http\Controllers\ProductListController::class, 'delete'])->name('delete');
Route::post('/product/search', [App\Http\Controllers\ProductListController::class, 'search'])->name('search');


Route::get('/productRegist', [App\Http\Controllers\ProductRegistController::class, 'index'])->name('productRegist');
Route::post('/productRegist', [App\Http\Controllers\ProductRegistController::class, 'regist'])->name('regist');

//Route::get('/productRegist', [App\Http\Controllers\ProductRegistController::class, 'index'])->name('productRegist');

Route::get('/productDetail/{id}', [App\Http\Controllers\ProductDetailController::class, 'index'])->name('productDetail');


Route::get('/productEdit/{id}', [App\Http\Controllers\ProductEditController::class, 'index'])->name('productEdit');
Route::post('/productEdit/{id}', [App\Http\Controllers\ProductEditController::class, 'edit'])->name('edit');