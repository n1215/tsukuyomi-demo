<?php

return [
    // framework service providers
    \N1215\Tsukuyomi\Providers\BootLoaderServiceProvider::class,
    \N1215\Tsukuyomi\Providers\HttpApplicationServiceProvider::class,
    \N1215\Tsukuyomi\Providers\RequestHandlerFactoryServiceProvider::class,

    // application service providers
    \App\Providers\EventServiceProvider::class,
    \App\Providers\HandlerServiceProvider::class,
    \App\Providers\LogServiceProvider::class,
    \App\Providers\MiddlewareServiceProvider::class,
    \App\Providers\RouteServiceProvider::class,
];
