<?php

namespace App\Domain\V2\SatuSehat\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Interfaces\Http\Controllers\ResponseTrait;

class StoreSatuSehatRequest extends FormRequest
{
    use ResponseTrait;

    public function rules(): array
    {
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, $this->respondWithError($validator->errors()));
    }

}
