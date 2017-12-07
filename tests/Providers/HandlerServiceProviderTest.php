<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Handlers\GetHelloHandler;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class HandlerServiceProviderTest extends TestCase
{
    public function test_register()
    {
        $container = new Container();
        $provider = new HandlerServiceProvider();
        $provider->register($container);

        $first = $container->get(GetHelloHandler::class);
        $this->assertInstanceOf(GetHelloHandler::class, $first);

        $second = $container->get(GetHelloHandler::class);
        $this->assertSame($first, $second);
    }
}
