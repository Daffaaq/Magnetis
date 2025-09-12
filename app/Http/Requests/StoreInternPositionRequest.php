<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInternPositionRequest extends FormRequest
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
            'department_id' => 'required|exists:departments,id',
            'name_intern_positions' => 'required|array',
            'name_intern_positions.*' => 'required|string|max:255',
            'description_intern_positions' => 'required|array',
            'description_intern_positions.*' => 'required|string|max:10000',
            'status_intern_positions' => 'required|array',
            'status_intern_positions.*' => 'required|in:active,inactive',
        ];
    }
}
