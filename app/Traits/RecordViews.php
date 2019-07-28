<?php


namespace App\Traits;


use App\Viewable;

trait RecordViews
{
    public function views()
    {
        return $this->morphMany(Viewable::class, 'viewable');
    }

    public function recordView(?int $userId = null)
    {
        $this->views()->create([
            'user_id' => $userId,
            'user_ip' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}