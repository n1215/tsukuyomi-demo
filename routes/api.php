<?php

use N1215\Hakudo\RequestMatcher\Path;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\JsonResponse;

/** @var \N1215\Hakudo\Router $router */

$router->add(Path::get('|/hello/(?<name>[A-z0-9]*)$|'), \App\Handlers\GetHelloHandler::class)->name('hello');
$router->add(Path::get('|/validation$|'), \App\Handlers\SampleValidationHandler::class)->name('hello');
$router->add(Path::get('|/closure$|'), function (Request $request): Response {
    return new JsonResponse(['closure']);
})->name('closure');

$router->add(Path::get('|/admin$|'), function (Request $request): Response {
    return new JsonResponse(['admin area']);
}, [\App\Middleware\BasicAuth::class])->name('admin');