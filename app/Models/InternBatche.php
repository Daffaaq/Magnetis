<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InternBatche extends Model
{
    use HasFactory;

    protected $table = 'intern_batches';

    protected $fillable = [
        'name_intern_batches',
        'description_intern_batches',
        'slug_intern_batches',
        'start_date_intern_batches',
        'end_date_intern_batches',
        'status_intern_batches',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($batch) {
            if (empty($batch->slug_intern_batches)) {
                $batch->slug_intern_batches = Str::slug($batch->name_intern_batches);
            }
        });
    }
}
