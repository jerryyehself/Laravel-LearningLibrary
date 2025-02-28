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
            'official_document.*.url' => 'required|url',
            'official_document.*.resource_type' => 'required',
            'official_document.*.content_language' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'official_document.*.url.required' => 'A official document is required',
            'official_document.*.url' => 'Should be active URL',
        ];
    }
}
