<?php
declare(strict_types=1);

namespace App\Requests;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SampleFormRequest
 * @package App\Requests
 */
class SampleFormRequest extends FormRequest
{
    public function authorize(ServerRequestInterface $request): bool
    {
        return true;
    }

    protected function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'string|max:10',
        ];
    }

    protected function attributes(): array
    {
        return [
            'id' => 'ID',
            'name' => 'name',
        ];
    }
}
