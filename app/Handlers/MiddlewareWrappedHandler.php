<?php

namespace App\Handlers;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class MiddlewareWrappedHandler
 * @package App\Handlers
 */
abstract class MiddlewareWrappedHandler implements RequestHandlerInterface
{
    /**
     * @var MiddlewareInterface
     */
    private $middleware;

    public function __construct(MiddlewareInterface $middleware)
    {
        $this->middleware = $middleware;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $callable = function (ServerRequestInterface $request): ResponseInterface {
            return $this->innerHandle($request);
        };

        return $this->middleware->process($request, new class($callable) implements RequestHandlerInterface {
            private $callable;

            public function __construct(callable $callable)
            {
                $this->callable = $callable;
            }

            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                return \call_user_func($this->callable, $request);
            }

        });
    }

    abstract protected function innerHandle(ServerRequestInterface $request): ResponseInterface;
}
