<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CorsMiddleware; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'api/login',
            'api/logout',
            'api/register',
            'api/expenses',
            'api/addExpenses',
            'api/expenses/*',
            'api/expenses/categories',
            'api/expenses/edit/*',
            'api/expenses/grouped',
            'api/expenses/delete/*',
            'api'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
