<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSelectionStepRequest extends FormRequest
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
            'name_selection_steps' => 'required|array|min:1',
            'name_selection_steps.*' => 'required|string|max:255',

            'description_selection_steps' => 'required|array|min:1',
            'description_selection_steps.*' => 'required|string|max:10000',

            'status_selection_steps' => 'required|array|min:1',
            'status_selection_steps.*' => 'required|in:active,inactive',
        ];
    }
}
