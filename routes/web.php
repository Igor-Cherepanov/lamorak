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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/currencies', App\Http\Controllers\CurrencyController::class);
Route::resource('/cities', App\Http\Controllers\CityController::class);
Route::resource('/banks', App\Http\Controllers\BankController::class);
Route::resource('/exchange-currencies', App\Http\Controllers\ExchangeCurrenyController::class);
Route::resource('/exchange-offices', App\Http\Controllers\ExchangeOfficeController::class);

