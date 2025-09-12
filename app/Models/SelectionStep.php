<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectionStep extends Model
{
    use HasFactory;

    protected $table = 'selection_steps';

    protected $fillable = [
        'name_selection_steps',
        'description_selection_steps',
        'status_selection_steps',
    ];
}
