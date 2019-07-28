<?php

namespace App\Observers;

use App\GalleryImage;

class GalleryImageObserver
{
    /**
     * Handle the gallery image "created" event.
     *
     * @param  \App\GalleryImage  $galleryImage
     * @return void
     */
    public function created(GalleryImage $galleryImage)
    {
        $galleryImage->recordActivity('created');
    }

    /**
     * Handle the gallery image "updated" event.
     *
     * @param  \App\GalleryImage  $galleryImage
     * @return void
     */
    public function updated(GalleryImage $galleryImage)
    {
        $galleryImage->recordActivity('updated');
    }

    /**
     * Handle the gallery image "deleted" event.
     *
     * @param  \App\GalleryImage  $galleryImage
     * @return void
     */
    public function deleted(GalleryImage $galleryImage)
    {
        $galleryImage->recordActivity('deleted');
    }

    /**
     * Handle the gallery image "restored" event.
     *
     * @param  \App\GalleryImage  $galleryImage
     * @return void
     */
    public function restored(GalleryImage $galleryImage)
    {
        $galleryImage->recordActivity('restored');
    }

    /**
     * Handle the gallery image "force deleted" event.
     *
     * @param GalleryImage $galleryImage
     *
     * @return void
     */
    public function forceDeleted( GalleryImage $galleryImage)
    {
        $galleryImage->recordActivity('forceDeleted');
        $galleryImage->deleteImage($galleryImage->url);
    }
}
