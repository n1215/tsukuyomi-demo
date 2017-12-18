<?php
declare(strict_types=1);

namespace App\Providers;

use App\Middleware\BasicAuth;
use App\Middleware\BenchMark;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class MiddlewareServiceProviderTest extends TestCase
{
    private $middlewareClasses = [
        BasicAuth::class,
        BenchMark::class
    ];

    public function test_register()
    {
        putenv('BASIC_AUTH_USER=user');
        putenv('BASIC_AUTH_PASSWORD=password');
        putenv('BASIC_AUTH_REALM=secret');

        $container = new Container();
        $container->bind(LoggerInterface::class, function () {
            return $this->createMock(LoggerInterface::class);
        });

        $provider = new MiddlewareServiceProvider();
        $provider->register($container);

        foreach ($this->middlewareClasses as $middlewareClass) {
            $first = $container->get($middlewareClass);
            $this->assertInstanceOf($middlewareClass, $first);

            $second = $container->get($middlewareClass);
            $this->assertSame($first, $second);
        }
    }
}
