<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Reaction;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationTrait;

class ReactionRequest extends FormRequest
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
            'status' => 'in:' . array_to_string(Reaction::STATUS),
            'model_type' => 'required|in:' . array_to_string(Reaction::MODEL_TYPE),
            'model_id' => 'required|exists:' . table_of_model_name($this->request->get('model_type')) . ',id',
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
            'status' => __('reaction status'),
            'model_id' => __('item id'),
            'model_type' => __('item type'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'status.in' => __('reaction status must be value of these values') . ' ' . array_to_string(Reaction::STATUS),
            'model_type.in' => __('item id must be value of these values') . ' ' . array_to_string(Reaction::MODEL_TYPE),
            'model_id.exists' => __('item id must exists in table of') . ' ' . table_of_model_name($this->request->get('model_type'))
        ];
    }
}
