<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/register', [RegisterController::class, 'register'])->middleware('api');

Route::post('/api/login', [LoginController::class, 'login'])->middleware('api');

Route::post('/api/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/api/expenses', [ExpenseController::class, 'index']);

Route::get('/api/expenses/categories', [ExpenseController::class, 'getCategories']);

Route::get('/api/expenses/{id}', [ExpenseController::class, 'getExpenseById']);

Route::get('/api/expenses/grouped', [ExpenseController::class, 'getGroupedExpenses']);

Route::post('/api/addExpenses', [ExpenseController::class, 'store'])->middleware('api');

Route::put('/api/expenses/edit/{id}', [ExpenseController::class, 'update'])->middleware('api');

Route::delete('/api/expenses/delete/{id}', [ExpenseController::class, 'destroy']);