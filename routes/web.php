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
Route::post('/home', [App\Http\Controllers\ExpensesController::class, 'store'])->name('addExpense');

Route::get('/profile', [App\Http\Controllers\ProfilesController::class, 'index'])->name('showProfile');
Route::post('/profile', [App\Http\Controllers\ProfilesController::class, 'updateBalance'])->name('updateBalance');

Route::get('/profile/expenses', [App\Http\Controllers\ProfilesController::class, 'showExpenses'])->name('showExpenses');
Route::get('/profile/incomes', [App\Http\Controllers\ProfilesController::class, 'showIncomes'])->name('showIncomes');
Route::get('/profile/summary', [App\Http\Controllers\ProfilesController::class, 'showSummary'])->name('showSummary');

Route::post('/category/save', [App\Http\Controllers\CategoriesController::class, 'store'])->name('addCategory');
