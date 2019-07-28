<?php

namespace App\Providers;

use App\Admin;
use App\Album;
use App\GalleryImage;
use App\Observers\AlbumObserver;
use App\Observers\GalleryImageObserver;
use App\Observers\PostObserver;
use App\Observers\SocialPageObserver;
use App\Observers\TrackObserver;
use App\Post;
use App\Role;
use App\SocialPage;
use App\Track;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('*', function ($view) {
            $roles = Cache::rememberForever('roles', function() {
                return Role::all() ;
            });

            return $roles;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Track::observe(TrackObserver::class);
        Album::observe(AlbumObserver::class);
        Post::observe(PostObserver::class);
        GalleryImage::observe(GalleryImageObserver::class);
        SocialPage::observe(SocialPageObserver::class);
    }
}
