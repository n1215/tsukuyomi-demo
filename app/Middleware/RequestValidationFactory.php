<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Requests\FormRequestInterface;

/**
 * Class RequestValidationFactory
 * @package App\Middleware
 */
class RequestValidationFactory
{
    /**
     * @inheritdoc
     */
    public function make(FormRequestInterface $formRequest): RequestValidation
    {
        return new RequestValidation($formRequest);
    }
}
