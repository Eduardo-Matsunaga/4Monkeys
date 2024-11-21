<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Aqui ficam outros middlewares globais
    protected $middleware = [
        // Middlewares globais, como TrustProxies, HandleCors, etc.
    ];

    // Aqui você registra middlewares para rotas específicas
    protected $routeMiddleware = [
        // Outros middlewares registrados para as rotas
        'auth.admin' => \App\Http\Middleware\AdminAuthenticated::class, // Registrar seu middleware
    ];
}
