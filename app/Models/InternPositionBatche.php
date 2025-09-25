<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InternPositionBatche extends Model
{
    use HasFactory;

    protected $table = 'intern_position_batches';

    protected $fillable = [
        'intern_position_id',
        'intern_batch_id',
        'intern_location_id',
        'quota_intern_position_batches',
        'slug_intern_position_batches',
        'status_intern_position_batches',
        'start_date_intern_position_batches',
        'end_date_intern_position_batches',
        'start_internship_position_batches',
        'end_internship_position_batches',
        'description_intern_position_batches',
        'apply_requirements_intern_position_batches',
        'benefits_intern_position_batches',
        'compensation_intern_position_batches',
        'compensation_amount_intern_position_batches',
        'compensation_description_intern_position_batches',
    ];

    // Relasi ke model InternPosition
    public function internPosition()
    {
        return $this->belongsTo(InternPosition::class);
    }

    // Relasi ke model InternBatch
    public function internBatch()
    {
        return $this->belongsTo(InternBatche::class);
    }

    // Relasi ke model InternLocation
    public function internLocation()
    {
        return $this->belongsTo(InternLocation::class);
    }

    public function selectionSteps()
    {
        return $this->hasMany(InternSelectionStep::class, 'intern_position_batch_id');
    }

    public function internSelectionSteps()
    {
        return $this->internPosition->internSelectionSteps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug_intern_position_batches)) {
                $positionName = optional($model->internPosition)->name_intern_position ?? 'posisi';
                $batchName = optional($model->internBatch)->name_intern_batches ?? 'batch';
                $slugBase = $positionName . ' ' . $batchName;
                $model->slug_intern_position_batches = Str::slug($slugBase);
            }
        });
    }
}
