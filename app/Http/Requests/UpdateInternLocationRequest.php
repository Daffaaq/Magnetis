<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInternLocationRequest extends FormRequest
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
            'intern_location_name' => 'required|string|max:255',
            'intern_location_address' => 'required|string|max:255',
            'intern_location_province' => 'nullable|string|max:100',
            'intern_location_regency' => 'nullable|string|max:100',
            'intern_location_district' => 'nullable|string|max:100',
            'intern_location_village' => 'nullable|string|max:100',
            'intern_location_country' => 'required|string|max:100',
            'intern_location_postal_code' => 'nullable|string|max:10',
            'intern_location_phone_number' => 'nullable|string|max:20',
            'intern_location_type' => 'required|string|max:50',
            'intern_location_status' => 'required|in:active,inactive',
        ];
    }
}
