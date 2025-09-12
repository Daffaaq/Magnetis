<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternSelectionStep extends Model
{
    use HasFactory;

    protected $table = 'intern_selection_steps';

    protected $fillable = [
        'intern_position_batch_id',
        'selection_step_id',
        'step_order_intern_selection_steps',
        'is_mondatory_intern_selection_steps',
        'is_invitation_only_intern_selection_steps',
        'description_intern_selection_steps',
        'estimated_start_date_intern_selection_steps',
        'estimated_end_date_intern_selection_steps',
        'status_intern_selection_steps',
    ];

    protected $casts = [
        'is_mondatory_intern_selection_steps' => 'boolean',
        'is_invitation_only_intern_selection_steps' => 'boolean',
    ];

    public function internPositionBatch()
    {
        return $this->belongsTo(InternPositionBatche::class);
    }


    public function selectionStep()
    {
        return $this->belongsTo(SelectionStep::class);
    }
}
