<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInternPositionBatcheRequest extends FormRequest
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
            'intern_position_id' => 'required|exists:intern_positions,id',
            'intern_batch_id' => 'required|exists:intern_batches,id',
            'intern_location_id' => 'required|exists:intern_locations,id',
            'quota_intern_position_batches' => 'required|integer|min:1',
            'status_intern_position_batches' => 'required|in:active,inactive',
            'start_date_intern_position_batches' => 'required|date',
            'end_date_intern_position_batches' => 'required|date|after_or_equal:start_date_intern_position_batches',
            'start_internship_position_batches' => 'required|date',
            'end_internship_position_batches' => 'required|date|after_or_equal:start_internship_position_batches',
            'description_intern_position_batches' => 'required|string',
            'apply_requirements_intern_position_batches' => 'required|string',
            'compensation_intern_position_batches' => 'required|in:paid,unpaid',
            'compensation_amount_intern_position_batches' => 'nullable|numeric',
            'compensation_description_intern_position_batches' => 'nullable|string|max:10000',
        ];
    }
}
