<?php

namespace App\Observers;

use App\SocialPage;

class SocialPageObserver
{
    /**
     * Handle the gallery image "created" event.
     *
     * @param  \App\SocialPage  $socialPage
     * @return void
     */
    public function created(SocialPage $socialPage)
    {
        $socialPage->recordActivity('created');
    }

    /**
     * Handle the gallery image "updated" event.
     *
     * @param  \App\SocialPage  $socialPage
     * @return void
     */
    public function updated(SocialPage $socialPage)
    {
        $socialPage->recordActivity('updated');
    }
    /**
     * Handle the social page "deleted" event.
     *
     * @param  \App\SocialPage  $socialPage
     * @return void
     */
    public function deleted(SocialPage $socialPage)
    {
        $socialPage->recordActivity('deleted');
        $socialPage->deleteImage($socialPage->icon);
    }
}
