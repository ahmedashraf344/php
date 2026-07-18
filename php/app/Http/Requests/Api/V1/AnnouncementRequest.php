<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Announcement;
use App\Rules\ARRegex;
use App\Rules\ENRegex;
use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'feature_image' => $fileValidation . '|file|image',
            'description_ar'=>'nullable|min:2',
            'description_en'=>'nullable|min:2',
            'type'=>'required|in:'.array_to_string(Announcement::TYPES),
            'enable_at'=>'nullable|date',
            'disable_at'=>'nullable|date|after:enable_at',
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
            'feature_image' => __('Feature image'),
            'description_ar'=>__('description in arabic'),
            'description_en'=>__('description in english'),
            'type'=>__('type'),
            'enable_at'=>__('enable announcement at'),
            'disable_at'=>__('disable announcement at'),
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
