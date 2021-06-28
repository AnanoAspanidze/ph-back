<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartRequest extends FormRequest
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
            'ka.short_desc' => "required",
            'ka.description' => "required",
            'video' => 'required',
        ];
    }

    public function messages() {
        return [
            'ka.title.required' => 'სათაურის მითითება აუცილებელია',
            'ka.short_desc.required' => 'მოკლე აღწერის მითითება აუცილებელია',
            'ka.description.required' => 'სრული აღწერის მითითება აუცილებელია',
            'video.required' => "ვიდეოს ლინკის მითითება აუცილებელია",
        ];
    }
}
