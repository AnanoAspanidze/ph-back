<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageAdditionalRequest extends FormRequest
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
            "direction" => "required",
            'topic_id' => "required|exists:topics,id",
            // 'type' => 'required|in:image,link,pdf,video',
            'link' => 'nullable|url',
            'pdf' => 'nullable|mimes:pdf|max:15048',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:4048'
        ];
    }

    public function messages() {
        return [
            'ka.title.required' => 'სათაურის მითთება აუცილებელია',
            'direction.required' => 'მიმართულების არჩევა აუცილებელია',
            'type.required' => 'ტიპის არჩევა აუცილებელია',
            'topic_id.required' => 'თემის არჩევა აუცილებელია',
            'topic_id.exists' => 'არჩეული ფორმა არარსებობს სისტემაში',
            'type.in' => 'ტიპის არჩევა აუცილებელია მოცემული სიიდან',            
            'link.url' => 'მისამართი არაკორექტულია',
            'image.mimes' => 'სურათის ვალიდური ფორმატები (jpeg,png,jpg,gif,svg)',
            'image.max' => 'სურათის მაქსიმალური მოცულობა არ უნდა აღემატებოდეს 4048 kb',
            'pdf.mimes' => 'PDF ვალიდური ფორმატები (pdf)',
            'pdf.max' => 'PDF მაქსიმალური მოცულობა არ უნდა აღემატებოდეს 4048 kb',
        ];
    }
}
