<?php
declare(strict_types=1);

namespace App\Providers;

use App\Handlers\GetHelloHandler;
use App\Handlers\SampleValidationHandler;
use Illuminate\Container\Container;

class HandlerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->singleton(GetHelloHandler::class);
        $container->singleton(SampleValidationHandler::class);
    }
}
