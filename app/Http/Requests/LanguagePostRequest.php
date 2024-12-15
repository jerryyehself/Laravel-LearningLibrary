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
            'official_document' => 'required | active_url'
        ];
    }

    public function messages()
    {
        return [
            'official_document.required' => 'A official document is required',
            'official_document.active_url' => 'Should be active URL',
        ];
    }
}
