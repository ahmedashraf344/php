<?php

namespace App\Http\Requests\Api\V1;

use App\Traits\JsonValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'shop_id' => 'required|exists:shops,id',
            'rate' => 'nullable|required_without:comment|numeric|between:1,5',
            'comment' => 'nullable|required_without:rate|min:3|max:300',
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
            'shop_id' => __('shop'),
            'rate' => __('rate'),
            'comment' => __('comment'),
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
