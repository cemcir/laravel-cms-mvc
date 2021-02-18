<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
            'blog_title'=>['required', 'regex:/^[A-Za-z ]+$/'],
            'blog_content'=>'required',
            'blog_file'=>'image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
