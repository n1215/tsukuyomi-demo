<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

class BasicAuth implements MiddlewareInterface
{
    /** @var string  */
    private $expectedAuthHeader;

    /** @var string  */
    private $realm;

    public function __construct(string $userName, string $password, string $realm)
    {
        $this->expectedAuthHeader = 'Basic ' . base64_encode("{$userName}:{$password}");
        $this->realm = $realm;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->expectedAuthHeader !== $request->getHeaderLine('Authorization')) {
            return new TextResponse(
                'Authentication required',
                401,
                ['WWW-Authenticate' => 'Basic realm="'. $this->realm . '"']
            );
        }

        return $handler->handle($request);
    }
}
