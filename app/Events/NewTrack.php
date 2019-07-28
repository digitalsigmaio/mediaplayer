<?php

namespace App\Events;

use App\Track;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewTrack implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Track
     */
    public $track;

    /**
     * Create a new event instance.
     *
     * @param Track $track
     */
    public function __construct(Track $track)
    {
        //
        $this->track = $track;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tracks');
    }

    public function broadcastAs()
    {
        return 'new.track';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->track->id,
            'name' => $this->track->title,
            'album' => $this->track->album->title
        ];
    }
}
