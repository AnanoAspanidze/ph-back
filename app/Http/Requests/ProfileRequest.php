<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'surname' => ['required', 'string', 'max:191'],
            'email' => ['nullable', 'string', 'email', 'max:191', Rule::unique('users')->ignore($this->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'სახელის მითთება აუცილებელია',
            'name.max' => 'სახელის მაქსიმალური ზომა 191 სიმბოლო',
            'surname.required' => 'გვარის მითთება აუცილებელია',
            'surname.max' => 'გვარის მაქსიმალური ზომა 191 სიმბოლო',
            'email.required' => 'Email შეყვანა აუცილებელია',
            'email.max' => 'Email მაქსიმალური ზომა 191 სიმბოლო',
            'email.unique' => 'Email აუცილებელია იყოს უნიკალური',
            'email.email' => 'Email-ის ფორმატი არაკორექტულია',
            'password.required' => 'პაროლის მითთება აუცილებელია',
            'password.min' => 'პაროლის მინიმალური ზომა 8 სიმბოლოა',
            'password.confirmed' => 'ხელმეორეთ შეყვანილი პაროლი არ ემთხვევა ორიგინალს'
        ];
    }
}
