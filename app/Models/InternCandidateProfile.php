<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternCandidateProfile extends Model
{
    use HasFactory;

    protected $table = 'intern_candidate_profiles';

    protected $fillable = [
        'fullname_intern_candidate_profiles',
        'email_intern_candidate_profiles',
        'date_of_birth_intern_candidate_profiles',
        'gender_intern_candidate_profiles',
        'university_intern_candidate_profiles',
        'major_intern_candidate_profiles',
        'semester_intern_candidate_profiles',
        'gpa_intern_candidate_profiles',
        'address_intern_candidate_profiles',
        'province_intern_candidate_profiles',
        'regency_intern_candidate_profiles',
        'district_intern_candidate_profiles',
        'village_intern_candidate_profiles',
        'country_intern_candidate_profiles',
        'phone_number_intern_candidate_profiles',
        'linkedin_intern_candidate_profiles',
        'github_intern_candidate_profiles',
        'portfolio_intern_candidate_profiles',
        'bio_intern_candidate_profiles',
        'soft_skills_intern_candidate_profiles',
        'hard_skills_intern_candidate_profiles',
        'profile_picture_intern_candidate_profiles',
        'type_profile_picture_intern_candidate_profiles',
        'user_id',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
