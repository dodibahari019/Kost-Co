<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user' => \App\Http\Middleware\UserMiddleware::class,
            'admin' => \App\Http\Middleware\RoleAdministrator::class,
            'kasir' => \App\Http\Middleware\RoleKasir::class,
            'owner' => \App\Http\Middleware\RoleOwner::class,
            'pengurus' => \App\Http\Middleware\IsPengurus::class,
            'penghuni' => \App\Http\Middleware\IsPenghuni::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
