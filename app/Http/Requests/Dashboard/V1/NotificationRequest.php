<?php

namespace App\Http\Requests\Dashboard\V1;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'title_en' => 'nullable|string|max:250',
            'title_ar' => 'nullable|string|max:250',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'date' => 'nullable|date'
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
            'content_ar' => __('Content Arabic'),
            'content_en' => __('Content English'),
            'date' => __('Date')
        ];
    }


}
