<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Middleware bawaan Laravel
        \App\Http\Middleware\Cors::class, // Tambahkan middleware CORS di sini
    ];

    // Middleware groups dan route middleware tetap ada di sini
}
