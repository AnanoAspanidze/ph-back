<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'token' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            // 'email.required' =>  __('site.register_email_required'),
            // 'email.string' => __('site.register_email_string'),
            // 'email.max' => __('site.register_email_limit'),
            // 'email.email' => __('site.register_email_valid'),
            // 'email.exists' => __('site.register_email_exists'),

            'password.required' => __('site.register_password_required'),
            'password.min' => __('site.register_password_min'),
            'password.confirmed' => __('site.register_password_confirmed'),
        ];
    }
}
