<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'termsOfUse' => ['required'],
            'privacy' => ['required'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'work_place' => ['nullable', 'string'],
            'region_id' => ['required', 'exists:regions,id']
        ];

        $position_id = $this->get("position_id");

        if(isset($position_id)) {
            
            if($this->get("position_id") === 'other') {
                $rules['position_name'] = ['required', 'string', 'max:255'];
            }else {
                $rules['position_id'] = ['exists:positions,id'];
            }

        }else {
            $rules['position_id'] = ['required', 'exists:positions,id'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' =>  __('site.register_name_required'),
            'name.string' => __('site.register_name_string'),
            'name.max' => __('site.register_name_limit'),

            'surname.required' =>  __('site.register_surname_required'),
            'surname.string' => __('site.register_surname_string'),
            'surname.max' => __('site.register_surname_limit'),

            'termsOfUse.required' =>  __('site.register_termsOfUse_required'),
            'privacy.required' => __('site.register_privacy_required'),

            'email.required' =>  __('site.register_email_required'),
            'email.string' => __('site.register_email_string'),
            'email.max' => __('site.register_email_limit'),
            'email.email' => __('site.register_email_valid'),
            'email.unique' => __('site.register_email_unique'),

            'password.required' => __('site.register_password_required'),
            'password.string' => __('site.register_password_string'),
            'password.min' => __('site.register_password_min'),
            'password.confirmed' => __('site.register_password_confirmed'),

            'password_confirmation.required' => __('site.register_password_confirmation_required'),

            
            'work_place.string' => __('site.register_work_place_string'),
            
            'position_name.required' =>  __('site.register_position_other_required'),
            'position_name.string' => __('site.register_position_other_string'),
            'position_name.max' => __('site.register_position_other_limit'),

            'position_id.required' =>  __('site.register_position_id_required'),
            'position_id.exists' => __('site.register_position_id_exists'),

            'region_id.required' =>  __('site.register_region_id_required'),
            'region_id.exists' => __('site.register_region_id_exists'),
        ];
    }
}
