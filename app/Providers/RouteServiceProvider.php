<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Routing\RoutingErrorResponder;
use Illuminate\Container\Container;
use N1215\Hakudo\Router;
use N1215\Http\Router\RouterInterface;
use N1215\Http\Router\RoutingErrorResponderInterface;
use N1215\Jugoya\RequestHandlerFactory;

class RouteServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(RouterInterface::class, function (Container $container) {
            $router = new Router($container->get(RequestHandlerFactory::class));

            require dirname(dirname(__DIR__)) . '/routes/api.php';

            return $router;
        });

        $container->singleton(RoutingErrorResponderInterface::class, RoutingErrorResponder::class);
    }
}
