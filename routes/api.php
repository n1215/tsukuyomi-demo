<?php

use N1215\Hakudo\RequestMatcher\Path;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/** @var \N1215\Hakudo\Router $router */

$router->add('get', Path::get('|/hello/(?<name>[A-z0-9]*)|'), \App\Http\Handlers\GetHelloHandler::class, [\App\Http\Middleware\HogeMiddleware::class]);
$router->add('closure', Path::get('|/closure|'), function (ServerRequestInterface $request): ResponseInterface {
    return new \Zend\Diactoros\Response\JsonResponse(['closure']);
});
