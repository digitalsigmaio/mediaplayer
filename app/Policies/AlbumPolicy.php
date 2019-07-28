<?php

namespace App\Policies;

use App\Admin;
use App\Album;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the album.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Album  $album
     * @return mixed
     */
    public function update(Admin $admin, Album $album)
    {
        return $admin instanceof Admin;
    }
}
