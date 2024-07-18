<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/register', [RegisterController::class, 'register'])->middleware('api');

Route::post('/api/login', [LoginController::class, 'login'])->middleware('api');