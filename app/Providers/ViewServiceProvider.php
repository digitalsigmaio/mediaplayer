<?php
/**
 * Created by: Manson
 * Date: 3/28/2019
 * Time: 10:51 AM
 */

namespace App\Providers;


use App\Artist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        View::composer('*', function ($view) {
            $view->with('artist', Artist::first());
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}