<?php

namespace App\Http\Requests\Api\V1;

use App\Rules\MinEditor;
use App\Rules\RequireEditor;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $group = $this->request->get('group_title');

        $generalValidation = ($group == 'general') ? 'required' : 'nullable';

        $termsValidation = ($group == 'terms_page') ? 'required' : 'nullable';

        $aboutValidation = ($group == 'about_page') ? 'required' : 'nullable';

        $validation = [
            'name_ar' => [$generalValidation, 'min:2', 'max:190'],
            'name_en' => ['nullable', 'min:2', 'max:190'],
            'copyrights_ar' => [$generalValidation, 'min:2', 'max:300'],
            'copyrights_en' => ['nullable', 'min:2', 'max:300'],
            'logo' => ['nullable', 'image'],

            'terms_title_ar' => [$termsValidation, 'min:2', 'max:190'],
            'terms_title_en' => ['nullable', 'min:2', 'max:190'],
            'terms_content_ar' => ['nullable'],
            'terms_content_en' => ['nullable'],

            'about_title_ar' => [$aboutValidation, 'min:2', 'max:190'],
            'about_title_en' => ['nullable', 'min:2', 'max:190'],
            'about_content_ar' => ['nullable'],
            'about_content_en' => ['nullable'],
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
            'name_ar' => __('Application name in arabic'),
            'name_en' => __('Application name in english'),
            'copyrights_ar' => __('Copyrights in arabic'),
            'copyrights_en' => __('Copyrights in english'),
            'logo' => __('logo'),
            'terms_title_ar' => __('Title in arabic'),
            'terms_title_en' => __('Title in english'),
            'terms_content_ar' => __('content in arabic'),
            'terms_content_en' => __('content in english'),
            'about_title_ar' => __('Title in arabic'),
            'about_title_en' => __('Title in english'),
            'about_content_ar' => __('content in arabic'),
            'about_content_en' => __('content in english'),
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
