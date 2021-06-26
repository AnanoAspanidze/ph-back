<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamePageRequest extends FormRequest
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
            'ka.title' => "required",
            'ka.instruction' => "required",
            'type' => "required",
        ];
    }

    public function messages() {
        return [
            'ka.title.required' => 'სათაურის მითითება აუცილებელია',
            'ka.instruction.required' => 'სავარჯიშოს ინსტრუქციის მითითება აუცილებელია',
            'type.required' => "ტიპის არჩევა აუცილებელია",            
        ];
    }
}
