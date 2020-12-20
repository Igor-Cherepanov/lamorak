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
Route::resource('/exchange-offices', App\Http\Controllers\ExchangeOfficeController::class);
Route::resource('/kushva', App\Http\Controllers\KushvaController::class);

Route::resource('/exchange-currencies', App\Http\Controllers\ExchangeCurrencyController::class);
Route::prefix('/exchange-currency')->name('ex-cur.')->group(function () {
    Route::get('/select-action', [\App\Http\Controllers\ExchangeCurrencyController::class, 'selectAction'])->name('select-action');
});

Route::prefix('users/{user}')->name('users.')->group(function () {
    Route::resource('/currency-balances', \App\Http\Controllers\Users\CurrencyBalanceController::class);

});



