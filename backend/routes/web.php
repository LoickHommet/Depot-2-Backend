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

Route::post('/api/expenses', [ExpenseController::class, 'store'])->middleware('api');