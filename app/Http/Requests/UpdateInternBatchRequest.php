<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInternBatchRequest extends FormRequest
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
            'name_intern_batches' => 'required|string|max:255',
            'description_intern_batches' => 'required|string|max:10000',
            'start_date_intern_batches' => 'required|date',
            'end_date_intern_batches' => 'required|date',
            'status_intern_batches' => 'required|in:upcoming,ongoing,completed',
        ];
    }
}
