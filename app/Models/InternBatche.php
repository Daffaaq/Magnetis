<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternBatche extends Model
{
    use HasFactory;

    protected $table = 'intern_batches';

    protected $fillable = [
        'name_intern_batches',
        'description_intern_batches',
        'start_date_intern_batches',
        'end_date_intern_batches',
        'status_intern_batches',
    ];
}
