<?php

namespace App\Http\Requests\Api\V1;

use App\Rules\ARRegex;
use App\Rules\ENRegex;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
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
        $fileValidation = ($this->method() == 'POST') ? 'required' : 'nullable';
        $validation = [
            'name_ar' => ['required', 'min:2', 'max:190', new ARRegex()],
            'name_en' => ['nullable', 'min:2', 'max:190', new ENRegex()],
            'category_id' => 'nullable|exists:categories,id',
            'feature_image' => $fileValidation . '|file|image',
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
            'name_ar' => __('Name in arabic'),
            'name_en' => __('Name in english'),
            'category_id' => __('Parent category'),
            'feature_image' => __('Feature image'),
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
