<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use N1215\Http\Router\RouterInterface;
use N1215\Http\Router\Handler\RoutingErrorResponderInterface;
use N1215\Http\Router\Handler\RoutingHandler;
use N1215\Http\Router\Handler\RoutingHandlerInterface;
use N1215\Jugoya\LazyRequestHandlerBuilder;
use N1215\Jugoya\RequestHandlerBuilderInterface;
use N1215\Tsukuyomi\BootLoader;
use N1215\Tsukuyomi\BootLoaderInterface;
use N1215\Tsukuyomi\Event\EventManager;
use N1215\Tsukuyomi\Event\EventManagerInterface;
use N1215\Tsukuyomi\Framework;
use N1215\Tsukuyomi\FrameworkInterface;
use N1215\Tsukuyomi\HttpApplication;
use N1215\Tsukuyomi\HttpApplicationInterface;
use PHPUnit\Framework\TestCase;

class HttpApplicationServiceProviderTest extends TestCase
{
    public function test_register()
    {
        $container = new Container();
        $container->bind(FrameworkInterface::class,function () use ($container) {
            return new Framework($container, __DIR__);
        });
        $container->bind(EventManagerInterface::class, EventManager::class);
        $container->bind(RequestHandlerBuilderInterface::class, function (Container $container) {
            return LazyRequestHandlerBuilder::fromContainer($container);
        });
        $container->bind(RouterInterface::class, function () {
            return $this->createMock(RouterInterface::class);
        });
        $container->bind(RoutingErrorResponderInterface::class, function () {
            return $this->createMock(RoutingErrorResponderInterface::class);
        });

        $provider = new HttpApplicationServiceProvider();

        $provider->register($container);

        $this->assertInstanceOf(HttpApplication::class, $container->get(HttpApplicationInterface::class));
        $this->assertInstanceOf(RoutingHandler::class, $container->get(RoutingHandlerInterface::class));
        $this->assertInstanceOf(BootLoader::class, $container->get(BootLoaderInterface::class));
    }
}
