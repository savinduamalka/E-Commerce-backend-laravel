<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'register',
        'login',
        'logout',
        'cart',
        'cart/*',
        'orders',
        'orders/*',
        'category',
        'category/*',
        'products',
        'products/*',
        'subscribe',
        'emails',
        'user/*',
        'admin/stats',
        'test',
    ];
}
