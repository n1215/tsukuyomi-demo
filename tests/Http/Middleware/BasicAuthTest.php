<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Interop\Http\Server\RequestHandlerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class BasicAuthTest extends TestCase
{
    public function test_process_returns_delegated_response_with_valid_authorization_header()
    {
        $url = 'https://example.com/admin';
        $request = (new ServerRequest([], [], $url))
            ->withHeader('Authorization', 'Basic dXNlcjpwYXNzd29yZA==');
        $response = new Response();

        $userName = 'user';
        $password = 'password';
        $realm = 'secret';
        $middleware = new BasicAuth($userName, $password, $realm);

        /** @var RequestHandlerInterface|MockObject $delegate */
        $delegate = $this->getMockBuilder(RequestHandlerInterface::class)->getMock();
        $delegate->expects($this->once())
            ->method('handle')
            ->with($request)
            ->willReturn($response);

        $result = $middleware->process($request, $delegate);

        $this->assertSame($response, $result);
    }

    public function test_process_returns_unauthorized_response_with_no_authorization_header()
    {
        $url = 'https://example.com/admin';
        $request = (new ServerRequest([], [], $url));

        $userName = 'user';
        $password = 'password';
        $realm = 'secret';
        $middleware = new BasicAuth($userName, $password, $realm);

        /** @var RequestHandlerInterface|MockObject $delegate */
        $delegate = $this->getMockBuilder(RequestHandlerInterface::class)->getMock();
        $delegate->expects($this->never())
            ->method('handle');

        $result = $middleware->process($request, $delegate);

        $this->assertEquals(401, $result->getStatusCode());
        $this->assertEquals('Basic realm="secret"', $result->getHeaderLine('WWW-Authenticate'));
    }

    public function test_process_returns_unauthorized_response_with_invalid_authorization_header()
    {
        $url = 'https://example.com/admin';
        $request = (new ServerRequest([], [], $url))
            ->withHeader('Authorization', 'Basic dXNlcjpwYXNzd29yZA');

        $userName = 'user';
        $password = 'password';
        $realm = 'secret';
        $middleware = new BasicAuth($userName, $password, $realm);

        /** @var RequestHandlerInterface|MockObject $delegate */
        $delegate = $this->getMockBuilder(RequestHandlerInterface::class)->getMock();
        $delegate->expects($this->never())
            ->method('handle');

        $result = $middleware->process($request, $delegate);

        $this->assertEquals(401, $result->getStatusCode());
        $this->assertEquals('Basic realm="secret"', $result->getHeaderLine('WWW-Authenticate'));
    }
}
