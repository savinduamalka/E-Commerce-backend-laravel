<?php 

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // ...existing code...
            \App\Http\Middleware\VerifyCsrfToken::class,
            // ...existing code...
        ],

        'api' => [
            // ...existing code...
            \App\Http\Middleware\VerifyCsrfToken::class,
            // ...existing code...
        ],
    ];
}
