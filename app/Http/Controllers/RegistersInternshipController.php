<?php

namespace App\Http\Controllers;

use App\Models\InternCandidateProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ActivityLogHelper;

class RegistersInternshipController extends Controller
{
    use ActivityLogHelper;
    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'fullname_intern_candidate_profiles' => 'required|string|max:255',
            'phone_number_intern_candidate_profiles' => 'required|string|max:255',
            'address_intern_candidate_profiles' => 'required|string|max:10000',
            'date_of_birth_intern_candidate_profiles' => 'required|date',
            'gender_intern_candidate_profiles' => 'required|in:male,female',
            'province_intern_candidate_profiles' => 'required|string',
            'regency_intern_candidate_profiles' => 'required|string',
            'district_intern_candidate_profiles' => 'required|string',
            'village_intern_candidate_profiles' => 'required|string',
            'country_intern_candidate_profiles' => 'required|string',
            'linkedin_intern_candidate_profiles' => 'nullable|url',
            'github_intern_candidate_profiles' => 'nullable|url',
            'portfolio_intern_candidate_profiles' => 'nullable|url',
        ]);

        // Proses validasi dan penyimpanan data ke dalam database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('candidate-intern');

        $this->logUserActivity(
            'Intern User Created',
            "Created new user with ID {$user->id}",
            $user->id,
            $user
        );

        $internCandidate = InternCandidateProfile::create([
            'fullname_intern_candidate_profiles' => $validated['fullname_intern_candidate_profiles'],
            'email_intern_candidate_profiles' => $validated['email'],
            'phone_number_intern_candidate_profiles' => $validated['phone_number_intern_candidate_profiles'],
            'address_intern_candidate_profiles' => $validated['address_intern_candidate_profiles'],
            'date_of_birth_intern_candidate_profiles' => $validated['date_of_birth_intern_candidate_profiles'],
            'gender_intern_candidate_profiles' => $validated['gender_intern_candidate_profiles'],
            'address_intern_candidate_profiles' => $validated['address_intern_candidate_profiles'],
            'province_intern_candidate_profiles' => $validated['province_intern_candidate_profiles'],
            'regency_intern_candidate_profiles' => $validated['regency_intern_candidate_profiles'],
            'district_intern_candidate_profiles' => $validated['district_intern_candidate_profiles'],
            'village_intern_candidate_profiles' => $validated['village_intern_candidate_profiles'],
            'country_intern_candidate_profiles' => $validated['country_intern_candidate_profiles'],
            'linkedin_intern_candidate_profiles' => $validated['linkedin_intern_candidate_profiles'],
            'github_intern_candidate_profiles' => $validated['github_intern_candidate_profiles'],
            'portfolio_intern_candidate_profiles' => $validated['portfolio_intern_candidate_profiles'],
            'user_id' => $user->id
        ]);

        $this->logUserActivity(
            'Intern Candidate Profile Created',
            "Created new intern candidate profile with ID {$internCandidate->id}",
            $user->id,
            $internCandidate
        );

        return redirect()->route('register.thanks')->with('success', 'Data berhasil ditambahkan');
    }
}
