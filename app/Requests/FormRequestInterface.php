<?php
declare(strict_types=1);

namespace App\Requests;

use Psr\Http\Message\ServerRequestInterface;

interface FormRequestInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function authorize(ServerRequestInterface $request): bool;

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function fails(ServerRequestInterface $request): bool;

    /**
     * @return array
     */
    public function errors(): array;
}
