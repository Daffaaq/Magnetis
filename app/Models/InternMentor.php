<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternMentor extends Model
{
    use HasFactory;

    protected $table = 'intern_mentors';

    protected $fillable = [
        'name_intern_mentors',
        'email_intern_mentors',
        'phone_intern_mentors',
        'department_id',
        'user_id',
        'status_intern_mentors',
        'bio_intern_mentors',
        'position_title_intern_mentors',
        'profile_picture_intern_mentors',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function positionBatchAssignments()
    {
        return $this->hasMany(MentorBatchAssignment::class, 'intern_mentor_id');
    }
}
