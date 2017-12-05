<?php

use N1215\Hakudo\RequestMatcher\Path;

/** @var \N1215\Hakudo\Router $router */

$router->add('get', Path::get('|/hello/(?<name>[A-z0-9]*)|'), \App\Http\Handlers\GetHelloHandler::class, [\App\Http\Middleware\HogeMiddleware::class]);
