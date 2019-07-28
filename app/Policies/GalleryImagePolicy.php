<?php

namespace App\Policies;

use App\Admin;
use App\GalleryImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the gallery image.
     *
     * @param  \App\Admin  $admin
     * @param  \App\GalleryImage  $galleryImage
     * @return mixed
     */
    public function update(Admin $admin, GalleryImage $galleryImage)
    {
        return $admin ? true : false;
    }
}
