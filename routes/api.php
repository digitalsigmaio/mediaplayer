<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->middleware(['api.header'])->group(function () {
   Route::post('login', 'LoginController@login');
   Route::post('register', 'RegisterController@register');
    // Artist
   Route::get('artist', 'ArtistController@index');
    // Albums
   Route::get('albums', 'AlbumController@index');
   Route::get('albums/{album}', 'AlbumController@show');
    // Tracks
    Route::get('tracks', 'TrackController@index');
    Route::get('tracks/{track}', 'TrackController@show');
    // Gallery
    Route::get('gallery', 'GalleryImageController@index');
    Route::get('gallery/{image}', 'GalleryImageController@show');
    // Posts
    Route::get('posts', 'PostController@index');
    Route::get('posts/{post}', 'PostController@show');
    // Social Pages
    Route::get('social-pages', 'SocialPageController@index');
    Route::get('social-pages/{socialPage}', 'SocialPageController@show');
    // Social Pages
    Route::get('videos', 'VideoController@index');
    Route::get('videos/{video}', 'VideoController@show');
});


