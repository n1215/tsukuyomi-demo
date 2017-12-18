<?php
declare(strict_types=1);

namespace App\Routing;

use N1215\Http\Router\RoutingErrorInterface;
use N1215\Http\Router\RoutingErrorResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class RoutingErrorResponder implements RoutingErrorResponderInterface
{
    public function respond(ServerRequestInterface $request, RoutingErrorInterface $error): ResponseInterface
    {
        return new JsonResponse(['message' => $error->getMessage()], $error->getStatusCode());
    }
}
