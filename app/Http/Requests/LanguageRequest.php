<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            "locale" => "required|in:ka,en,ru,gr,es|unique:languages,locale"
        ];
    }

    public function messages()
    {
        return [
            'locale.required' => 'ენის არჩევა აუცილებელია!',
            'locale.in' => 'აირჩიეთ ენა მოცემული ცხრილიდან!',
            'locale.unique'  => 'არჩეული ენა უკვე არსებობს სისტემაში!',
        ];
    }
}