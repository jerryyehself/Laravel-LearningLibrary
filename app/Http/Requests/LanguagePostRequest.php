<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguagePostRequest extends FormRequest
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
            'offical_document' => 'required | url'
        ];
    }

    public function messages()
    {
        return [
            'offical_document.required' => 'A official document is required',
            'offical_document.url' => 'Should be URL',
            'body.required' => 'A message is required',
        ];
    }
}
