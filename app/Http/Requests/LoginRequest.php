<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [            
            'email.required' =>  __('site.register_email_required'),
            'email.string' => __('site.register_email_string'),
            'email.max' => __('site.register_email_limit'),
            'email.email' => __('site.register_email_valid'),
            'email.exists' => __('site.register_email_unique'),

            'password.required' => __('site.register_password_required'),         
        ];
    }
}
