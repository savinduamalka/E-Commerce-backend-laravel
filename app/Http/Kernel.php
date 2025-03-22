<?php 

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // ...existing code...
            // CSRF middleware removed
            // ...existing code...
        ],

        'api' => [
            // ...existing code...
        ],
    ];
}
