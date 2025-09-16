<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorBatchAssignment extends Model
{
    use HasFactory;
    protected $table = 'mentor_batch_assignments';

    protected $fillable = [
        'intern_mentor_id',
        'intern_position_batch_id',
        'status_mentor_batch_assignments',
        'note_mentor_batch_assignments',
    ];

    public function internMentor()
    {
        return $this->belongsTo(InternMentor::class);
    }

    // Relasi ke InternPositionBatch
    public function internPositionBatch()
    {
        return $this->belongsTo(InternPositionBatche::class);
    }
}
