<?php
declare(strict_types=1);

namespace App\Providers;

use App\Middleware\BasicAuth;
use App\Middleware\BenchMark;
use Illuminate\Container\Container;
use Psr\Log\LoggerInterface;

class MiddlewareServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->singleton(BenchMark::class, function (Container $container) {
            return new BenchMark($container->get(LoggerInterface::class));
        });

        $container->singleton(BasicAuth::class, function () {
            return new BasicAuth(
                getenv('BASIC_AUTH_USER'),
                getenv('BASIC_AUTH_PASSWORD'),
                getenv('BASIC_AUTH_REALM')
            );
        });
    }
}
