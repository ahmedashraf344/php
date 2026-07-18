<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        $validation = [
            'content' => 'required|min:2|max:300',
            'status' => 'in:' . array_to_string(Comment::STATUS),
            'model_type' => 'required|in:' . array_to_string(Comment::MODEL_TYPE),
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
            'content' => __('content'),
            'user_id' => __('user'),
            'status' => __('status'),
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
            'model_type.in'=>__('item id must be value of these values').' '.array_to_string(Comment::MODEL_TYPE),
            'model_id.exists'=>__('item id must exists in table of').' '.table_of_model_name($this->request->get('model_type'))
        ];
    }
}
