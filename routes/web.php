<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->middleware('guest:admin');

Auth::routes();

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/admins', 'AdminController@index')->name('admins.index');
    Route::post('/admins', 'AdminController@store')->name('admins.index');
    Route::get('/admins/create', 'AdminController@create')->name('admins.create');
    Route::delete('/admins/{admin}', 'AdminController@destroy');
    Route::get('/account', 'AdminController@show')->name('admins.show');
    Route::get('/admins/{admin}/edit', 'AdminController@edit');
    Route::patch('/admins/{admin}/edit', 'AdminController@update');

    Route::post('/artist', 'ArtistController@update')->name('artist.update');

    // Albums
    Route::get('/albums/trash', 'AlbumController@trash')->name('albums.trash');
    Route::delete('/albums/trash/{albumId}', 'AlbumController@destroyForever');
    Route::patch('/albums/trash/{albumId}', 'AlbumController@restore');

    Route::resource('albums', 'AlbumController');

    // Tracks
    Route::get('/tracks/trash', 'TrackController@trash')->name('tracks.trash');
    Route::delete('/tracks/trash/{trackId}', 'TrackController@destroyForever');
    Route::patch('/tracks/trash/{trackId}', 'TrackController@restore');

    Route::resource('tracks', 'TrackController');

    // Gallery
    Route::get('/gallery-images/trash', 'GalleryImageController@trash')->name('gallery-images.trash');
    Route::delete('/gallery-images/trash/{imageId}', 'GalleryImageController@destroyForever');
    Route::patch('/gallery-images/trash/{imageId}', 'GalleryImageController@restore');

    Route::resource('gallery-images', 'GalleryImageController');

    // Posts
    Route::get('/posts/trash', 'PostController@trash')->name('posts.trash');
    Route::delete('/posts/trash/{postId}', 'PostController@destroyForever');
    Route::patch('/posts/trash/{postId}', 'PostController@restore');

    Route::resource('posts', 'PostController');

    // Social Pages
    Route::resource('social-pages', 'SocialPageController');

    // Videos
    Route::resource('videos', 'VideoController');
});

Route::namespace('Auth\Admin')->prefix('admin')->group(function() {
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');
    // Registration
    Route::post('register', 'RegisterController@register')->name('admin.register');
    // Password Reset
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.password.update');
});

// Test

//Route::get('/test', function () {
//    return view('test');
//});

Route::post('/test', function (\Illuminate\Http\Request $request) {
    try {
        $image = new \App\Image();
        $name = $image->uploadImage($request->image, 'webp');
        return $image->getImageUrl($name);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::debug($e->getMessage());
        return 'failed';
    }
});