<?php

namespace App\Domain\V2\SatuSehat\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Interfaces\Http\Controllers\ResponseTrait;

class GenerateUrlKYCRequest extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'nik' => ['required', 'digits:16'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->respondWithError($validator->errors()));
    }
}
