<?php

namespace App\Traits;

trait ActivityLogHelper
{
    public function formatDataToString(array $data): string
    {
        return collect($data)
            ->map(fn($value, $key) => "{$key}: {$value}")
            ->implode(' | ');
    }

    public function logUserActivity(string $activity, string $description, int $userId, $subject = null, array $customData = null): void
    {
        $dataString = $this->formatDataToString(
            $customData ?? (
                is_object($subject) && method_exists($subject, 'getLoggableData')
                ? $subject->getLoggableData()
                : (is_object($subject) ? $subject->toArray() : [])
            )
        );


        event(new \App\Events\UserActivityEvent(
            $activity,
            $description,
            $userId,
            $subject,
            $dataString
        ));
    }
}
