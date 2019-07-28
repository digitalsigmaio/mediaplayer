<?php

namespace App\Policies;

use App\Admin;
use App\Track;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the track.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Track  $track
     * @return mixed
     */
    public function update(Admin $admin, Track $track)
    {
        return $admin instanceof Admin;
    }
}
