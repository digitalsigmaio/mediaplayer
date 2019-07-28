<?php


namespace App\Traits;


use App\Activitable;

trait RecordActivity
{
    public function activities()
    {
        return $this->morphMany(Activitable::class, 'activitable');
    }

    public function recordActivity(string $activityType)
    {
        $this->activities()->create([
            'admin_id' => auth('admin')->id(),
            'type' => $activityType,
        ]);
    }
}