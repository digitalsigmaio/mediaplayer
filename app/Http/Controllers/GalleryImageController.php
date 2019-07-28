<?php

namespace App\Http\Controllers;

use App\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class GalleryImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gallery.index', ['images' => GalleryImage::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @param GalleryImage $galleryImage
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, GalleryImage $galleryImage)
    {
        $this->authorize( 'update', $galleryImage );

        $request->validate( [ 'caption' => 'nullable|max:255',
                              'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000' // max 10000 kb
                            ] );

        try {
            $galleryImage->url = $galleryImage->uploadImage( $request->image, 'webp' );
            $galleryImage->caption = $request->caption;
            $galleryImage->save();

            session()->flash( 'success', 'Image added!' );
            return redirect()->route( 'gallery-images.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to add image!' );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryImage $galleryImage)
    {
        return view('gallery.edit', compact('galleryImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\GalleryImage $galleryImage
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, GalleryImage $galleryImage)
    {
        $this->authorize( 'update', $galleryImage );

        $request->validate( [ 'caption' => 'nullable|max:255',
                              'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000'
                            ] );

        try {
            if ( $request->image !== null ) $galleryImage->url = $galleryImage->updateImage( $request->image, $galleryImage->url, 'webp' );

            $galleryImage->caption = $request->caption;
            $galleryImage->save();

            session()->flash( 'success', 'Image updated!' );
            return back();
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to update image!' );
        }
    }

    public function destroy( GalleryImage $galleryImage )
    {
        $this->authorize( 'update', $galleryImage );

        try {
            $galleryImage->delete();

            return response( 'success', 204 );
        } catch ( \Exception $exception ) {
            return response( $exception->getMessage(), 422 );
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        return view( 'gallery-images.trash', [ 'images' => GalleryImage::onlyTrashed()->get() ] );
    }

    /**
     * @param int $imageId
     *
     * @return Response
     */
    public function restore( int $imageId ): Response
    {
        try {
            GalleryImage::onlyTrashed()->whereId( $imageId )->first()->restore();

            return \response( 'GalleryImage restored!', 200 );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage());
            return response( 'Failed to restore album', 422 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $imageId
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyForever( int $imageId )
    {
        $galleryImage = GalleryImage::onlyTrashed()->whereId( $imageId )->first();

        $this->authorize( 'update', $galleryImage );

        try {
            $galleryImage->forceDelete();

            return response( 'success', 204 );
        } catch ( \Exception $exception ) {
            return response( $exception->getMessage(), 422 );
        }
    }
}
