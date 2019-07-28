<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
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
        return view( 'albums.index', [ 'albums' => Album::latest()->get() ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'albums.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Album $album
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store( Request $request, Album $album )
    {
        $this->authorize( 'update', $album );

        $request->validate( [ 'title' => 'required|max:100|unique:albums', 'year' => 'required', 'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000' // max 10000 kb
                            ] );


        try {
            $album->image = $album->uploadImage( $request->image, 'webp' );
            $album->title = $request->title;
            $album->year = $this->getYear( $request );
            $album->save();

            session()->flash( 'success', 'Album created!' );
            return redirect()->route( 'albums.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to create album!' );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album $album
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( Album $album )
    {
        return view( 'albums.edit', compact( 'album' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Album $album
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update( Request $request, Album $album )
    {
        $this->authorize( 'update', $album );

        $request->validate( [ 'title' => 'required|max:100|unique:albums,title,' . $album->id,
                              'year' => 'required',
                              'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000' // max 10000 kb
                            ] );


        try {
            if ( $request->image !== null ) $album->image = $album->updateImage( $request->image, $album->image, 'webp' );
            $album->title = $request->title;
            $album->year = $this->getYear( $request );
            $album->save();

            session()->flash( 'success', 'Album updated!' );
            return back();
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to update album!' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album $album
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy( Album $album )
    {
        $this->authorize( 'update', $album );

        try {
            $album->delete();

            return response( 'success', 204 );
        } catch ( \Exception $exception ) {
            return response( $exception->getMessage(), 422 );
        }
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    protected function getYear( Request $request ): string
    {
        preg_match( '/(\d+)(-)(\d{2})/', $request->year, $matches );
        return $matches[1];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        return view( 'albums.trash', [ 'albums' => Album::onlyTrashed()->get() ] );
    }

    /**
     * @param int $albumId
     *
     * @return Response
     */
    public function restore( int $albumId ): Response
    {
        try {
            Album::onlyTrashed()->whereId( $albumId )->first()->restore();

            return \response( 'Album restored!', 200 );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage());
            return response( 'Failed to restore album', 422 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $albumId
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyForever( int $albumId )
    {
        $album = Album::onlyTrashed()->whereId( $albumId )->first();

        $this->authorize( 'update', $album );

        try {
            $album->forceDelete();

            return response( 'success', 204 );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage());
            return response( 'Error while deleting the album permanently', 422 );
        }
    }
}
