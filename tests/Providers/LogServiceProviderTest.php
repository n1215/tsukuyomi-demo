<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use Monolog\Logger;
use N1215\Tsukuyomi\Framework;
use N1215\Tsukuyomi\FrameworkInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class LogServiceProviderTest extends TestCase
{
    public function test_register()
    {
        $container = new Container();
        $container->bind(FrameworkInterface::class, function (Container $container) {
            return new Framework($container, dirname(dirname(__DIR__)));
        });

        $provider = new LogServiceProvider();
        $provider->register($container);

        $this->assertInstanceOf(Logger::class, $container->get(LoggerInterface::class));
    }
}
