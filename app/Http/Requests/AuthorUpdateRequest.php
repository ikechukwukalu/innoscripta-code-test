<?php

namespace App\Http\Requests;

class AuthorUpdateRequest extends BaseFormRequest
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
            'id' => 'required|exists:authors,id,deleted_at,NULL',
            'name' => 'sometimes|string|max:150',
            'twitter' => 'sometimes|string|max:150|unique:authors,twitter',
            'website' => 'sometimes|url|max:255',
            'imageUrl' => 'sometimes|url|max:255',
            'active' => 'sometimes|in:0,1'
        ];
    }
}
