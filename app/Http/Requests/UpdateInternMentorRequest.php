<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateInternMentorRequest extends FormRequest
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
        $mentorId = $this->route('mentor');
        Log::info('Mentor ID in validation: ' . $mentorId);

        return [
            'name_intern_mentors' => 'required|string|max:255',
            'email_intern_mentors' => [
                'required',
                'email',
                Rule::unique('intern_mentors', 'email_intern_mentors')->ignore($mentorId, 'id'),
            ],
            'phone_intern_mentors' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'status_intern_mentors' => 'required|in:active,inactive',
            'bio_intern_mentors' => 'nullable|string',
            'position_title_intern_mentors' => 'nullable|string',
            'profile_picture_intern_mentors' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
