<?php

use N1215\Hakudo\RequestMatcher\Path;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\JsonResponse;

/** @var \N1215\Hakudo\Router $router */

$router->add('get', Path::get('|/hello/(?<name>[A-z0-9]*)$|'), \App\Handlers\GetHelloHandler::class);
$router->add('closure', Path::get('|/closure$|'), function (Request $request): Response {
    return new JsonResponse(['closure']);
});

$router->add('admin', Path::get('|/admin$|'), function (Request $request): Response {
    return new JsonResponse(['admin area']);
}, [\App\Middleware\BasicAuth::class]);