<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FirstPageRequest extends FormRequest
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
            // 'ka.sub_title' => "required",
            // 'ka.description' => "required",
            // 'parent' => "nullable|exists:resoures,id",
            'hex_code' => 'required',
            'illustration' => [Rule::requiredIf(!isset($this->id)),'image','mimes:jpeg,png,jpg,gif,svg','max:4048']
        ];
    }

    public function messages() {
        return [
            'ka.sub_title.required' => 'ქვესათაურის მითითება აუცილებელია',
            'ka.description.required' => 'ტექსტის მითითება აუცილებელია',
            'hex_code.required' => "ფერის მითითება აუცილებელია",
            // 'parent.required' => 'არჩეული მშობელი არარსებობს სისტემაში',
            'illustration.required' => 'ილუსტრაციის ატვირთვა აუცილებელია',
            'illustration.mimes' => 'ილუსტრაციის ვალიდური ფორმატები (jpeg,png,jpg,gif,svg)',
            'illustration.max' => 'ილუსტრაციის მაქსიმალური მოცულობა არ უნდა აღემატებოდეს 4048 kb',

        ];
    }
}
