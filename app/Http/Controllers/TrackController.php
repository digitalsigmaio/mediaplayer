<?php

namespace App\Http\Controllers;

use App\Album;
use App\Events\NewTrack;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TrackController extends Controller
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
        return view( 'tracks.index', [ 'tracks' => Track::latest()->get() ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'tracks.create', [ 'albums' => Album::all() ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Track $track
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store( Request $request, Track $track )
    {
        $this->authorize( 'update', $track );

        $request->validate( [ 'title'    => 'required|max:100|unique:tracks', 'audio' => 'required|mimetypes:audio/mpeg|max:100000', // max 20000 kb
                              'ringtone' => 'mimetypes:audio/mpeg|max:20000', // max 20000 kb
                            ] );


        try {
            $track->url = $track->uploadAudio( $request->audio );
            if ( $request->hasFile( 'ringtone' ) ) $track->ringtone_url = $track->uploadAudio( $request->ringtone );
            $track->album_id = $request->album_id;
            $track->title = $request->title;
            $track->vodafone = $request->vodafone;
            $track->orange = $request->orange;
            $track->etisalat = $request->etisalat;
            $track->save();

            if ($request->has('notify') && $request->notify) {
                broadcast(new NewTrack($track))->toOthers();
            }

            session()->flash( 'success', 'Track created!' );
            return redirect()->route( 'tracks.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to create track!' );
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Track $track
     *
     * @return \Illuminate\Http\Response
     */
    public function show( Track $track )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track $track
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( Track $track )
    {
        $albums = Album::orderBy( 'title', 'asc' )->get();
        return view( 'tracks.edit', compact( [ 'track', 'albums' ] ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Track $track
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update( Request $request, Track $track )
    {
        $this->authorize( 'update', $track );

        $request->validate( [ 'title'    => 'required|max:100|unique:tracks,title,' . $track->id, 'audio' => 'mimetypes:audio/mpeg|max:100000', // max 20000 kb
                              'ringtone' => 'mimetypes:audio/mpeg|max:20000', // max 20000 kb
                            ] );


        try {
            if ( $request->hasFile( 'audio' ) ) $track->url = $track->updateAudio( $request->audio, $track->url );
            if ( $request->hasFile( 'ringtone' ) ) $track->ringtone_url = $track->updateAudio( $request->ringtone, $track->ringtone_url );
            $track->album_id = $request->album_id;
            $track->title = $request->title;
            $track->vodafone = $request->vodafone;
            $track->orange = $request->orange;
            $track->etisalat = $request->etisalat;
            $track->save();

            session()->flash( 'success', 'Track updated!' );
            return redirect()->route( 'tracks.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to update track!' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Track $track
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy( Track $track )
    {
        $this->authorize( 'update', $track );

        try {
            $track->delete();

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
        $tracks = Track::onlyTrashed()->get()->filter(function ( $track) {
            return $track->album !== null;
        })->values();

        return view('tracks.trash', ['tracks' =>  $tracks]);
    }

    /**
     * @param int $trackId
     *
     * @return Response
     */
    public function restore(int $trackId): Response
    {
        try {
            Track::onlyTrashed()->whereId($trackId)->first()->restore();

            return \response('Track restored!', 200);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return response('Failed to restore track', 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $trackId
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyForever( int $trackId )
    {
        $track = Track::onlyTrashed()->whereId($trackId)->first();

        $this->authorize( 'update', $track );

        try {
            $track->forceDelete();

            return response( 'success', 204 );
        } catch ( \Exception $exception ) {
            return response( $exception->getMessage(), 422 );
        }
    }
}
