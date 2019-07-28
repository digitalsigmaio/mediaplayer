<?php

namespace App\Observers;

use App\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $post->recordActivity('created');
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        $post->recordActivity('updated');
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        $post->recordActivity('deleted');
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        $post->recordActivity('restored');
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        $post->recordActivity('forceDeleted');
        $post->deleteImage($post->image);
    }
}
