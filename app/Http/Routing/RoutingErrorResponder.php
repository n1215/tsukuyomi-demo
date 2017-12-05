<?php
declare(strict_types=1);

namespace App\Http\Routing;

use N1215\Http\Router\RoutingErrorInterface;
use N1215\Http\Router\RoutingErrorResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class RoutingErrorResponder implements RoutingErrorResponderInterface
{
    public function respond(RoutingErrorInterface $error): ResponseInterface
    {
        return new JsonResponse(['message' => $error->getMessage()], $error->getStatusCode());
    }
}
