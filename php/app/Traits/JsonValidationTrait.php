<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait JsonValidationTrait
{
    protected function failedValidation(Validator $validator): void
    {
        if (\Request::wantsJson()) {
            throw new HttpResponseException(json_response(null, __('validation errors'), 422, $validator->errors()));
        } else {
            Parent::failedValidation($validator);
        }
    }
}
