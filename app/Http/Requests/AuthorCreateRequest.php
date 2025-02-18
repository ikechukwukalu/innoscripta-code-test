<?php

namespace App\Http\Requests;

class AuthorCreateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'twitter' => 'required|string|max:150|unique:authors,twitter',
            'website' => 'required|url|max:255',
            'imageUrl' => 'required|url|max:255',
            'active' => 'sometimes|in:0,1'
        ];
    }
}
