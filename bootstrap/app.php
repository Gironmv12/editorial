<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Definir alias para middlewares específicos usando array
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleare::class, // Corregido el nombre de la clase
            'user' => \App\Http\Middleware\UserMiddleware::class,
            'user_or_admin' => \App\Http\Middleware\UserOrAdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();