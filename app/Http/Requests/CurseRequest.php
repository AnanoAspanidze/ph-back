<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurseRequest extends FormRequest
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
            'ka.short_desc' => "required",
            "video" => "required",
            'topic_id' => [Rule::requiredIf(!isset($this->id)),'exists:topics,id']
        ];
    }

    public function messages() {
        return [
            'ka.short_desc.required' => 'მოკლე აღწერის მითთება აუცილებელია',            
            'topic_id.required' => 'თემის არჩევა აუცილებელია',
            'topic_id.exists' => 'არჩეული თემა არარსებობს სისტემაში',
            'video.required' => 'ვიდეოს ლინკის მითითება აუცილებელია',
        ];
    }
}
