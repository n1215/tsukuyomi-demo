<?php
declare(strict_types=1);

namespace App\Providers;

use App\Routing\RoutingErrorResponder;
use Illuminate\Container\Container;
use N1215\Hakudo\Router;
use N1215\Http\Router\Result\RoutingResultFactory;
use N1215\Http\Router\RouterInterface;
use N1215\Http\Router\Handler\RoutingErrorResponderInterface;
use N1215\Jugoya\RequestHandlerBuilderInterface;
use N1215\Tsukuyomi\FrameworkInterface;

class RouteServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->singleton(RouterInterface::class, function (Container $container) {
            $framework = $container->get(FrameworkInterface::class);
            $router = new Router($container->get(RequestHandlerBuilderInterface::class), new RoutingResultFactory());

            $routingPath = $framework->path('routes/api.php');
            require $routingPath;

            return $router;
        });

        $container->singleton(RoutingErrorResponderInterface::class, RoutingErrorResponder::class);
    }
}
