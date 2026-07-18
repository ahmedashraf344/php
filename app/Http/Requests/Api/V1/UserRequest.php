<?php

namespace App\Http\Requests\Api\V1;

use App\Traits\JsonValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRequest extends FormRequest
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
        $conditionalInput = ($this->method() == 'POST') ? 'required' : 'nullable';
        $user=$this->route('user') ?$this->route('user')['id']: null;
        if ($this->route()->getName()=='api.profile'){
            $user = JWTAuth::parseToken()->authenticate()['id'];
            $conditionalInput='nullable';
        }

        $validation = [
            'name' => 'required|min:3|max:70',
            'email' => 'required|email|max:180|unique:users,email,'.$user.',id,deleted_at,NULL',
            'mobile' => 'required|numeric|digits:11|unique:users,mobile,'.$user.',id,deleted_at,NULL',
            'password' => $conditionalInput . '|min:6|max:100',
            'password_confirmation' => 'nullable|required_with:password|same:password',
            'agree_terms' => $conditionalInput,
            'avatar' => 'nullable|image',
            'device_id' => 'required|string',
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
            'name' => __('name'),
            'email' => __('email'),
            'mobile' => __('mobile'),
            'password' => __('password'),
            'password_confirmation' => __('password confirmation'),
            'agree_terms' => __('agree terms'),
            'avatar' => __('avatar'),
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
