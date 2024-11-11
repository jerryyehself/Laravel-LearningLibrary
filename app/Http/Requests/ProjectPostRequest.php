<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectPostRequest extends FormRequest
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
        return ($this->request->has('display')) ? [] : [
            'project_name_cn' => 'required',
            'release_url' => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'project_name_cn.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }
}
