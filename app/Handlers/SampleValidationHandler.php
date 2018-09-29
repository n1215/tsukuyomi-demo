<?php

namespace App\Handlers;

use App\Middleware\RequestValidationFactory;
use App\Requests\SampleFormRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class SampleValidationHandler extends MiddlewareWrappedHandler
{
    /**
     * @param SampleFormRequest $formRequest
     * @param RequestValidationFactory $middlewareFactory
     */
    public function __construct(SampleFormRequest $formRequest, RequestValidationFactory $middlewareFactory)
    {
        parent::__construct($middlewareFactory->make($formRequest));
    }

    protected function innerHandle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(['success id = ' . $request->getQueryParams()['id']]);
    }
}
