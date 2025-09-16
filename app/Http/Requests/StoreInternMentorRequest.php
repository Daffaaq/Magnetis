<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInternMentorRequest extends FormRequest
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
            'nickname_intern_mentors' => 'required|string|max:255',
            'password_intern_mentors' => 'required|string|min:8',
            'name_intern_mentors' => 'required|string|max:255',
            'email_intern_mentors' => 'required|email|unique:intern_mentors,email_intern_mentors',
            'phone_intern_mentors' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'status_intern_mentors' => 'required|in:active,inactive',
            'bio_intern_mentors' => 'required|string',
            'position_title_intern_mentors' => 'required|string',
            'profile_picture_intern_mentors' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
