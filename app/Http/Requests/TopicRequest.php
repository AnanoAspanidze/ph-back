<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopicRequest extends FormRequest
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
            'ka.tags' => "required",
            'illustration' => [Rule::requiredIf(!isset($this->id)),'image','mimes:jpeg,png,jpg,gif,svg','max:4048']
        ];
    }

    public function messages() {
        return [
            'ka.title.required' => 'სათაურის მითთება აუცილებელია',
            'ka.tags.required' => 'თეგების მითთება აუცილებელია',
            
            'illustration.required' => 'ილუსტრაციის ატვირთვა აუცილებელია',
            'illustration.mimes' => 'ილუსტრაციის ვალიდური ფორმატები (jpeg,png,jpg,gif,svg)',
            'illustration.max' => 'ილუსტრაციის მაქსიმალური მოცულობა არ უნდა აღემატებოდეს 4048 kb',
        ];
    }
}
