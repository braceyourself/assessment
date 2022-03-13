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


Route::view('/login', 'login')->name('login')->middleware('guest');

Route::group(['middleware' => ['auth:web']], function() {
    Route::redirect('/', '/dashboard');
    Route::view('/dashboard', 'dashboard');

    Route::resource('/brands', 'App\Http\Controllers\BrandController');
    Route::resource('/stores', 'App\Http\Controllers\StoreController');
    Route::resource('/stores/{store}/journal', 'App\Http\Controllers\JournalController');

});