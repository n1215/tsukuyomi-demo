<?php
declare(strict_types=1);

namespace App\Http\Routing;

use N1215\Http\Router\RoutingError;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class RoutingErrorResponderTest extends TestCase
{
    public function test_respond()
    {
        $request = new ServerRequest();
        $responder = new RoutingErrorResponder();
        $statusCode = 404;
        $message = 'route not found';
        $routingError = new RoutingError($statusCode, $message);

        $response = $responder->respond($request, $routingError);

        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals("{\"message\":\"{$message}\"}", $response->getBody()->__toString());
    }
}
