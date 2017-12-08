<?php

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Container\Container;
use App\Container\ContainerBuilder;
use N1215\Tsukuyomi\FrameworkInterface;
use N1215\Tsukuyomi\Framework;
use N1215\Tsukuyomi\HttpApplicationInterface;

(new Dotenv\Dotenv(dirname(__DIR__)))->load();

call_user_func(function () {
    $providerClasses = require dirname(__DIR__) . '/config/providers.php';
    $container = (new ContainerBuilder($providerClasses))->build();
    $container->singleton(FrameworkInterface::class, function (Container $container) {
        return new Framework($container, dirname(__DIR__));
    });
    /** @var HttpApplicationInterface $app */
    $app =  $container->get(HttpApplicationInterface::class);

    $request = Zend\Diactoros\ServerRequestFactory::fromGlobals();
    $app->run($request);
});
