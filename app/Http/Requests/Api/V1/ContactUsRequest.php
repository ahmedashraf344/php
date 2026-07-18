<?php

namespace App\Http\Requests\Api\V1;

use App\Models\ContactUs;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class ContactUsRequest extends FormRequest
{
    use JsonValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation = [
            'email' => 'required|email|max:190',
            'message' => 'required|max:700',
            'status' => 'in:' . array_to_string(ContactUs::STATUS)
        ];

        return $validation;
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => __('contact email'),
            'message' => __('message'),
            'status' => __('status')
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}
