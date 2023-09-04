<?php

use App\Http\Controllers\ProductColtroller;
use App\Http\Controllers\MakeSaleController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['controller' => ProductColtroller::class, 'middleware' => ['auth']], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/new-sale', 'create')->name('create');
});

Route::group(['controller' => DashboardController::class, 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/sale-view/{sale}', 'saleView')->name('sale-view');
});

Route::get('/make-sale', MakeSaleController::class)->name('make-sale')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
