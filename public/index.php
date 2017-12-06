<?php

require __DIR__.'/../vendor/autoload.php';

(new \Dotenv\Dotenv(dirname(__DIR__)))->load();

call_user_func(function () {
    $providerClasses = require dirname(__DIR__) . '/config/providers.php';
    $container = (new \N1215\Tsukuyomi\ContainerBuilder($providerClasses))->build();
    $container->singleton(\N1215\Tsukuyomi\FrameworkInterface::class, function (\Illuminate\Container\Container $container) {
        return new \N1215\Tsukuyomi\Framework($container, realpath(__DIR__ . '/../'));
    });
    $app =  $container->get(\N1215\Tsukuyomi\HttpApplicationInterface::class);

    $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals();
    $app->run($request);
});
