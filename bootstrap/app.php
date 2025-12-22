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
    ->withMiddleware(function (Middleware $middleware): void {
        // Cấu hình guest middleware redirect về dashboard nếu đã đăng nhập
        $middleware->redirectGuestsTo('/login');
        $middleware->redirectUsersTo('/dashboard');
        
        // Đăng ký admin middleware
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Tắt CSRF cho API testing (CHỈ DÙNG KHI DEVELOPMENT)
        $middleware->validateCsrfTokens(except: [
            'login',
            'products/*',
            'products',
            'api/*', // API endpoints không cần CSRF protection
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
