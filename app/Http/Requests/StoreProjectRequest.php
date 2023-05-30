<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:150|unique:projects',
            'cover_image' => 'nullable|max:1024',
            'content' => 'nullable',
            'type_id' => 'nullable|exists:types,id',
            'tecnologies' => 'exists:tecnologies,id'
        ];
    }
}