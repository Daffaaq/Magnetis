<?php

namespace App\Listeners;

use App\Events\UserActivityEvent;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class LogUserActivityListener
{
    public function handle(UserActivityEvent $event): void
    {
        ActivityLog::create([
            'user_id' => $event->userId,
            'activity' => $event->activity,
            'subject_type' => $event->subject ? get_class($event->subject) : null,
            'description' => $event->description,
            'url' => Request::fullUrl(),
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'data' => $event->data,
        ]);
    }
}
