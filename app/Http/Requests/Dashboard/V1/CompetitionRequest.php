<?php

namespace App\Http\Requests\Dashboard\V1;

use Illuminate\Foundation\Http\FormRequest;

class CompetitionRequest extends FormRequest
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
        return [
            'name_ar' => 'required|string|max:250',
            'name_en' => 'required|string|max:250',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'active' => 'nullable|in:0,1',
            'min_number' => 'required|numeric',
            'max_number' => 'required|numeric'
        ];
    }


    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes()
    {
        return [
            'title_ar' => __('Title Arabic'),
            'title_en' => __('Title English'),
            'description_ar' => __('Decription Arabic'),
            'description_en' => __('Decription English'),
            'active' => __('Active'),
            'min_number' => 'Min Number',
            'max_number' => 'Max Number'
        ];
    }
}
