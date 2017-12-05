<?php

return [

    // framework service providers
    \N1215\Tsukuyomi\Providers\BootLoaderServiceProvider::class,
    \N1215\Tsukuyomi\Providers\RequestHandlerFactoryServiceProvider::class,
    \N1215\Tsukuyomi\Providers\RoutingHandlerServiceProvider::class,
    \N1215\Tsukuyomi\Providers\HttpApplicationServiceProvider::class,

    // application service providers
    \App\Providers\RouteServiceProvider::class,
    \App\Providers\EventManagerServiceProvider::class,
    \App\Providers\HandlerServiceProvider::class,
];
