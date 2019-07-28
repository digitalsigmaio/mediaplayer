<?php

namespace App\Observers;

use App\Album;
use App\Track;

class AlbumObserver
{
    /**
     * Handle the album "created" event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function created(Album $album)
    {
        $album->recordActivity('created');
    }

    /**
     * Handle the album "updated" event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function updated(Album $album)
    {
        $album->recordActivity('updated');

    }

    /**
     * Handle the album "deleted" event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function deleted(Album $album)
    {
        $album->recordActivity('deleted');
        $album->tracks->each->delete();
    }

    /**
     * Handle the album "restored" event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function restored(Album $album)
    {
        $album->recordActivity('restored');
        $album->tracks()->onlyTrashed()->get()->each(function($track) {
            $track->restore();
        });
    }

    /**
     * Handle the album "force deleted" event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function forceDeleted(Album $album)
    {
        $album->recordActivity('forceDeleted');
        $album->deleteImage($album->image);
        Track::onlyTrashed()->where('album_id', $album->id)->get()->each(function ($track) {
            $track->forceDelete();
        });
    }
}
