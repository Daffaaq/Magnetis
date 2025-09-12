<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInternSelectionStepRequest extends FormRequest
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
            'selection_step_id' => 'required|exists:selection_steps,id',
            'step_order_intern_selection_steps' => 'required|integer',
            'is_mondatory_intern_selection_steps' => 'required|boolean',
            'is_invitation_only_intern_selection_steps' => 'required|boolean',
            'description_intern_selection_steps' => 'required|string|max:10000',
            'estimated_start_date_intern_selection_steps' => 'required|date',
            'estimated_end_date_intern_selection_steps' => 'required|date|after_or_equal:estimated_start_date_intern_selection_steps',
            'status_intern_selection_steps' => 'required|in:active,inactive',
        ];
    }
}
