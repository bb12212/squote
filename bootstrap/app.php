<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ProviderMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Override database configuration
$_ENV['DB_CONNECTION'] = 'pgsql';
$_ENV['DB_HOST'] = 'db.qdoccfwsthzarruwswvz.supabase.co';
$_ENV['DB_PORT'] = '5432';
$_ENV['DB_DATABASE'] = 'postgres';
$_ENV['DB_USERNAME'] = 'postgres';
$_ENV['DB_PASSWORD'] = '!372d8TtcW47AJ.';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'provider' => ProviderMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
