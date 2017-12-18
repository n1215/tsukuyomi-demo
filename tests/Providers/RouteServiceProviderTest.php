<?php
declare(strict_types=1);

namespace App\Providers;

use App\Routing\RoutingErrorResponder;
use Illuminate\Container\Container;
use N1215\Hakudo\Router;
use N1215\Http\Router\RouterInterface;
use N1215\Http\Router\RoutingErrorResponderInterface;
use N1215\Jugoya\LazyRequestHandlerBuilder;
use N1215\Jugoya\RequestHandlerBuilderInterface;
use N1215\Tsukuyomi\Framework;
use N1215\Tsukuyomi\FrameworkInterface;
use PHPUnit\Framework\TestCase;

class RouteServiceProviderTest extends TestCase
{
    public function test_register()
    {
        $container = new Container();
        $container->bind(FrameworkInterface::class, function (Container $container) {
            return new Framework($container, dirname(dirname(__DIR__)));
        });
        $container->bind(RequestHandlerBuilderInterface::class, function (Container $container) {
            return LazyRequestHandlerBuilder::fromContainer($container);
        });

        $provider = new RouteServiceProvider();
        $provider->register($container);

        $this->assertInstanceOf(Router::class, $container->get(RouterInterface::class));
        $this->assertInstanceOf(RoutingErrorResponder::class, $container->get(RoutingErrorResponderInterface::class));
    }
}
