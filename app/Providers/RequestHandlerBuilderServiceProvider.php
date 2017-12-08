<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use N1215\Jugoya\RequestHandlerBuilderInterface;
use N1215\Jugoya\LazyRequestHandlerBuilder;

class RequestHandlerBuilderServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(RequestHandlerBuilderInterface::class, function (Container $container) {
            return LazyRequestHandlerBuilder::fromContainer($container);
        });
    }
}
