<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Post;
use App\Rules\ARRegex;
use App\Rules\ENRegex;
use App\Traits\JsonValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name_ar' => ['required', 'min:2', 'max:190', new ARRegex()],
            'name_en' => ['nullable', 'min:2', 'max:190', new ENRegex()],
            'content_ar' => 'required|min:2|max:900',
            'content_en' => 'nullable|min:2|max:900',
            'status' => 'in:' . array_to_string(Post::STATUS),
            'image' => 'nullable|file|image',
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
            'name_ar' => __('title in arabic'),
            'name_en' => __('title in english'),
            'content_ar' => __('content in arabic'),
            'content_en' => __('content in english'),
            'status' => __('status'),
            'image' => __('image'),
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
