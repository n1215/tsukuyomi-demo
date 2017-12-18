<?php
declare(strict_types=1);

namespace App\Handlers;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class GetHelloHandlerTest extends TestCase
{
    public function test_handle_with_no_name_attribute()
    {
        $handler = new GetHelloHandler();
        $request = new ServerRequest();

        $response = $handler->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals('["Hello, world!"]', $response->getBody()->__toString());

    }

    public function test_handle_with_name_attribute()
    {
        $handler = new GetHelloHandler();
        $request = (new ServerRequest())
            ->withAttribute('name', 'Tom');

        $response = $handler->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals('["Hello, Tom!"]', $response->getBody()->__toString());
    }
}
