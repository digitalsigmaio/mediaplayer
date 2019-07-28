<?php

namespace App\Observers;

use App\Track;

class TrackObserver
{
    /**
     * Handle the track "created" event.
     *
     * @param  \App\Track  $track
     * @return void
     */
    public function created(Track $track)
    {
        $track->recordActivity('created');
    }

    /**
     * Handle the track "updated" event.
     *
     * @param  \App\Track  $track
     * @return void
     */
    public function updated(Track $track)
    {
        $track->recordActivity('updated');
    }

    /**
     * Handle the track "deleted" event.
     *
     * @param  \App\Track  $track
     * @return void
     */
    public function deleted(Track $track)
    {
        $track->recordActivity('deleted');
    }

    /**
     * Handle the track "restored" event.
     *
     * @param  \App\Track  $track
     * @return void
     */
    public function restored(Track $track)
    {
        $track->recordActivity('restored');
    }

    /**
     * Handle the track "force deleted" event.
     *
     * @param  \App\Track  $track
     * @return void
     */
    public function forceDeleted(Track $track)
    {
        $track->recordActivity('forceDeleted');
        $track->deleteAudio($track->url);
        $track->ringtone_url ? $track->deleteAudio($track->ringtone_url) : null;
    }
}
