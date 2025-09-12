<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'activity',
        'subject_type',
        'description',
        'url',
        'date',
        'time',
        'data',
        'ip_address',
        'user_agent',
    ];

    /**
     * Relasi ke model User (optional jika kamu ingin akses user-nya)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
