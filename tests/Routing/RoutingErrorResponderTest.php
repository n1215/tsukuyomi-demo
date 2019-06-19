<?php
declare(strict_types=1);

namespace App\Routing;

use N1215\Http\Router\Exception\RouteNotFoundException;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class RoutingErrorResponderTest extends TestCase
{
    public function test_respond()
    {
        $request = new ServerRequest();
        $responder = new RoutingErrorResponder();
        $message = 'route not found';
        $statusCode = 404;
        $routingException = new RouteNotFoundException($message);

        $response = $responder->respond($routingException, $request);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals("{\"message\":\"{$message}\"}", $response->getBody()->__toString());
    }
}
