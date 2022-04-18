<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Mime\Header\Headers;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $domain = parse_url($this->resource, PHP_URL_HOST);
        $this->merge([
            // "contentype" => get_headers($this->resource, true)['Content-Type'],
            "contentype" => $domain,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contentype' => '',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'contentType.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }
}
