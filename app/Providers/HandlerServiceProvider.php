<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Handlers\GetHelloHandler;
use App\Http\Middleware\FugaMiddleware;
use App\Http\Middleware\HogeMiddleware;
use Illuminate\Container\Container;

class HandlerServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(GetHelloHandler::class);
        $container->singleton(HogeMiddleware::class);
        $container->singleton(FugaMiddleware::class);
    }
}

