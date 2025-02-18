<?php

namespace App\Http\Requests;

use App\Enums\UserPreferenceType;

class UserPreferenceCreateRequest extends BaseFormRequest
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
        $table = [
            UserPreferenceType::SOURCE->value => 'news_sources',
            UserPreferenceType::AUTHOR->value => 'authors',
            UserPreferenceType::CATEGORY->value => 'categories',
        ];

        $type = $this->input('type');

        if (empty($type)) {
            return [];
        }

        return [
            'type' => 'required|in:' . implode(',', UserPreferenceType::toArray()),
            'source_type' => 'required_if:type,' . UserPreferenceType::SOURCE->value . '|in:' . implode(',', UserPreferenceType::sourcesToArray()),
            'preferential_id' => "required|exists:{$table[$type]},id,deleted_at,NULL",
        ];
    }
}
