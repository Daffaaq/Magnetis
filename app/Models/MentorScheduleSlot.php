<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorScheduleSlot extends Model
{
    use HasFactory;

    protected $table = 'mentor_schedule_slots';

    protected $fillable = [
        'intern_mentor_id',
        'mentor_batch_assignments_id',
        'intern_selection_step_id',
        'date_mentor_schedule_slots',
        'start_time_mentor_schedule_slots',
        'end_time_mentor_schedule_slots',
        'location_mentor_schedule_slots',
        'meeting_link_mentor_schedule_slots',
        'is_booked_mentor_schedule_slots',
    ];

    /**
     * Relasi ke mentor (intern_mentors)
     */
    public function internMentor()
    {
        return $this->belongsTo(InternMentor::class);
    }

    /**
     * Relasi ke mentor_batch_assignments
     */
    public function mentorBatchAssignment()
    {
        return $this->belongsTo(MentorBatchAssignment::class);
    }

    /**
     * Relasi ke intern_selection_steps
     */
    public function internSelectionStep()
    {
        return $this->belongsTo(InternSelectionStep::class);
    }
}
