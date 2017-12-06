<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class BenchMark implements MiddlewareInterface
{
    /** @var LoggerInterface  */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $start = microtime(true);

        $response = $handler->handle($request);

        $time = microtime(true) - $start;

        $ms = number_format($time * 1000, 1);
        $message = "{$request->getMethod()} {$request->getUri()->__toString()} ({$response->getStatusCode()}) : processed in {$ms} ms.";
        $this->logger->info($message);

        return $response;
    }
}
