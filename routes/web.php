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
Route::post('/home', [App\Http\Controllers\TransactionsController::class, 'store'])->name('addExpense');

Route::get('/profile', [App\Http\Controllers\ProfilesController::class, 'index'])->name('showProfile');
Route::post('/profile', [App\Http\Controllers\ProfilesController::class, 'updateBalance'])->name('updateBalance');

Route::get('/profile/add/expense', [App\Http\Controllers\TransactionsController::class, 'addExpense'])->name('addExpenseForm');
Route::get('/profile/expenses', [App\Http\Controllers\TransactionsController::class, 'showTransactions'])->name('showTransactions');
Route::get('/profile/summary/{month}', [App\Http\Controllers\SummaryController::class, 'showSummary'])->name('showSummary');
Route::get('/profile/summary/{month}/{category}', [App\Http\Controllers\SummaryController::class, 'showCategory'])->name('showCategory');

Route::post('/category/save', [App\Http\Controllers\CategoriesController::class, 'store'])->name('addCategory');
