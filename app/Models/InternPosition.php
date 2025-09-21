<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternPosition extends Model
{
    use HasFactory;

    protected $table = 'intern_positions';

    protected $fillable = [
        'name_intern_positions',
        'description_intern_positions',
        'department_id',
        'status_intern_positions',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function internSelectionSteps()
    {
        return $this->hasMany(InternSelectionStep::class);
    }
}
