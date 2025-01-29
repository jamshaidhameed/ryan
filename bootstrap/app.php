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
         $middleware->web(append:[
            \App\Http\Middleware\SetLocale::class,
        ]);  
        $middleware->alias([
            'redirect_if_not_authenticated' => App\Http\Middleware\RedirectIfNotAuthenticated::class,
            'url_redirect' => App\Http\Middleware\UrlRedirect::class,
            'set_locale' => App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
