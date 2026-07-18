<?php

namespace App\Http\Requests\Api\V1;

use App\Rules\ARRegex;
use App\Rules\ENRegex;
use App\Traits\JsonValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
        $fileValidation = ($this->method() == 'POST') ? 'required' : 'nullable';
        $categoryValidation = $this->routeIs('shops.store') ? 'nullable' : 'required';

        $validation = [
            'name_ar' => ['required', 'min:2', 'max:190', new ARRegex()],
            'name_en' => ['nullable', 'min:2', 'max:190', new ENRegex()],
            'category_id' => $categoryValidation . '|exists:categories,id',
            'feature_image' => $fileValidation . '|file|image',
            'more_images.*' => 'nullable|file|image',
            'mobile_1' => 'nullable|digits:11',
            'mobile_2' => 'nullable|digits:11',
            'phone_1' => 'nullable|digits:10',
            'phone_2' => 'nullable|digits:10',
            'hotline' => 'nullable|digits_between:4,11',
            'address_ar' => ['nullable', 'min:2', 'max:300', new ARRegex()],
            'address_en' => ['nullable', 'min:2', 'max:300', new ENRegex()],
            'latitude' => 'nullable|numeric'/*|digits_between:1,40|max:30*/,
            'longitude' => 'nullable|numeric'/*|max:30*/,
            'facebook' => 'nullable|url|max:500',
            'instagram' => 'nullable|url|max:500',
            'user_id' => 'nullable|exists:users,id',
            'working_days_ar' => 'nullable|string|min:3|max:190',
            'working_days_en' => 'nullable|string|min:3|max:190',
            'start_at' => 'nullable',
            'end_at' => 'nullable',
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
            'name_ar' => __('name in arabic'),
            'name_en' => __('name in english'),
            'feature_image' => __('feature image'),
            'more_images' => __('more images'),
            'more_images.*' => __('image'),
            'category_id' => __('category'),
            'mobile_1' => __('mobile 1'),
            'mobile_2' => __('mobile 2'),
            'phone_1' => __('phone 1'),
            'phone_2' => __('phone 2'),
            'hotline' => __('hotline'),
            'address_ar' => __('address in arabic'),
            'address_en' => __('address in english'),
            'latitude' => __('latitude'),
            'longitude' => __('longitude'),
            'facebook' => __('facebook page link'),
            'instagram' => __('instagram page link'),
            'user_id' => __('user'),
            'working_days_ar' => __('working days in arabic'),
            'working_days_en' => __('working days in english'),
            'start_at' => __('start working at'),
            'end_at' => __('end working at'),
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
