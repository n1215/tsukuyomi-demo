<?php
declare(strict_types=1);

namespace App\Routing;

use N1215\Http\Router\Exception\RouteNotFoundException;
use N1215\Http\Router\Exception\RoutingException;
use N1215\Http\Router\Handler\RoutingErrorResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class RoutingErrorResponder implements RoutingErrorResponderInterface
{
    public function supports(RoutingException $exception): bool
    {
        return $exception instanceof RouteNotFoundException;
    }

    public function respond(RoutingException $exception, ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['message' => $exception->getMessage()], 404);
    }
}
