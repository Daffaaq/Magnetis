<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActivityEvent
{
    use Dispatchable, SerializesModels;

    public $activity;
    public $description;
    public $userId;
    public $subject;
    public $data; // tambahkan ini

    public function __construct(string $activity, string $description = null, int $userId = null, object $subject = null, $data = null)
    {
        $this->activity = $activity;
        $this->description = $description ?? "User performed {$activity}";
        $this->userId = $userId ?? auth()->id();
        $this->subject = $subject;
        $this->data = $data; // isi data tambahan
    }
}
