<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'siswa' => \App\Http\Middleware\StudentMiddleware::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // <-- PASTIKAN GUEST JUGA DIALIAS DI SINI
        ]);

        // Anda juga bisa menambahkan middleware grup atau global di sini jika perlu
        // Contoh:
        // $middleware->web(append: [
        //     \App\Http\Middleware\RedirectIfAuthenticated::class, // Jika Anda ingin ini selalu aktif untuk grup web
        // ]);

        // $middleware->append(\App\Http\Middleware\PreventBackHistory::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
