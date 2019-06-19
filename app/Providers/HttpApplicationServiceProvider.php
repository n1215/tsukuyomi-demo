<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use N1215\Http\Router\RouterInterface;
use N1215\Http\Router\Handler\RoutingErrorResponderInterface;
use N1215\Http\Router\Handler\RoutingHandler;
use N1215\Http\Router\Handler\RoutingHandlerInterface;
use N1215\Jugoya\RequestHandlerBuilderInterface;
use N1215\Tsukuyomi\BootLoader;
use N1215\Tsukuyomi\BootLoaderInterface;
use N1215\Tsukuyomi\Event\EventManagerInterface;
use N1215\Tsukuyomi\FrameworkInterface;
use N1215\Tsukuyomi\HttpApplication;
use N1215\Tsukuyomi\HttpApplicationInterface;
use Zend\Diactoros\Response\SapiEmitter;

class HttpApplicationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $this->registerBootLoader($container);
        $this->registerRoutingHandler($container);
        $this->registerHttpApplication($container);
    }

    private function registerBootLoader(Container $container)
    {
        $container->singleton(BootLoaderInterface::class, function (Container $container) {
            /** @var FrameworkInterface $framework */
            $framework = $container->get(FrameworkInterface::class);
            $bootstrapConfigPath = $framework->path('config/bootstrappers.php');
            $bootstrapperClasses = require $bootstrapConfigPath;
            return new BootLoader($bootstrapperClasses);
        });
    }

    private function registerRoutingHandler(Container $container)
    {
        $container->singleton(RoutingHandlerInterface::class, function (Container $container) {
            return new RoutingHandler(
                $container->get(RouterInterface::class),
                $container->get(RoutingErrorResponderInterface::class)
            );
        });
    }

    private function registerHttpApplication(Container $container)
    {
        $container->singleton(HttpApplicationInterface::class, function (Container $container) {
            /** @var RequestHandlerBuilderInterface $handlerBuilder */
            $handlerBuilder = $container->get(RequestHandlerBuilderInterface::class);
            /** @var FrameworkInterface $framework */
            $framework = $container->get(FrameworkInterface::class);
            $middlewareConfigPath = $framework->path('config/middlewares.php');
            $middlewareClasses = require $middlewareConfigPath;
            $requestHandler = $handlerBuilder->build(RoutingHandlerInterface::class, $middlewareClasses);

            return new HttpApplication(
                $container->get(BootLoaderInterface::class),
                $requestHandler,
                new SapiEmitter(),
                $container->get(EventManagerInterface::class)
            );
        });
    }
}
