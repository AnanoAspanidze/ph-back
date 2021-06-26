<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'answers.1.ka.answer' => "required",
            'answers.2.ka.answer' => "required",
            'type' => "required",
            'isRight.*' => "required"
        ];
    }

    public function messages() {
        return [
            'ka.title.required' => 'სათაურის მითითება აუცილებელია',
            'answers.1.ka.answer.required' => 'პასუხი 1 მითითება აუცილებელია',
            'answers.2.ka.answer.required' => 'პასუხი 2 მითითება აუცილებელია',
            'type.required' => "კითხვის ტიპის არჩევა აუცილებელია",
            'isRight.*.required' => "პასუხის (პასუხების) არჩევა აუცილებელია"
        ];
    }
}
