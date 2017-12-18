<?php
declare(strict_types=1);

namespace App\Middleware;

use Interop\Http\Server\RequestHandlerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class BenchMarkTest extends TestCase
{
    public function test_process()
    {
        $url = 'https://example.com/hello';
        $request = new ServerRequest([], [], $url);
        $response = new Response();

        /** @var LoggerInterface|MockObject $logger */
        $logger = $this->getMockBuilder(LoggerInterface::class)->getMock();
        $logger->expects($this->once())
            ->method('info')
            ->with($this->matchesRegularExpression("|GET https://example\.com/hello \(200\) : processed in \d\.\d ms\.|"));

        $middleware = new BenchMark($logger);

        /** @var RequestHandlerInterface|MockObject $delegate */
        $delegate = $this->getMockBuilder(RequestHandlerInterface::class)->getMock();
        $delegate->expects($this->once())
            ->method('handle')
            ->with($request)
            ->willReturn($response);

        $result = $middleware->process($request, $delegate);

        $this->assertSame($response, $result);
    }
}
