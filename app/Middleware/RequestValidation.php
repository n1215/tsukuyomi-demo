<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Requests\FormRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class RequestValidation
 * @package App\Middleware
 */
class RequestValidation implements MiddlewareInterface
{
    /**
     * @var FormRequestInterface
     */
    private $formRequest;

    /**
     * @param FormRequestInterface $formRequest
     */
    public function __construct(FormRequestInterface $formRequest)
    {
        $this->formRequest = $formRequest;
    }

    /**
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->formRequest->authorize($request)) {
            return new JsonResponse([
                'message' => 'unauthorized'
            ], 403);
        }

        if ($this->formRequest->fails($request)) {
            return new JsonResponse([
                'message' => 'validation error',
                'errors' => $this->formRequest->errors()
            ], 422);
        }

        return $handler->handle($request);
    }
}
