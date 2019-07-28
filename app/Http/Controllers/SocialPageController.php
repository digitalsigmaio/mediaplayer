<?php

namespace App\Http\Controllers;

use App\SocialPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SocialPageController extends Controller
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
        return view('social.index', ['socials' => SocialPage::all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('social.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param SocialPage $socialPage
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, SocialPage $socialPage)
    {
        $this->authorize('update', $socialPage);

        $request->validate([
            'provider' => 'required|string|unique:social_pages',
            'link' => 'required|string|unique:social_pages',
            'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000',
                           ]);

        try {
            $socialPage->icon = $socialPage->uploadImage( $request->image, 'webp' );
            $socialPage->link = $request->link;
            $socialPage->provider = $request->provider;
            $socialPage->save();

            session()->flash( 'success', 'Social page added!' );
            return redirect()->route( 'social-pages.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to add social page!' );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialPage  $socialPage
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialPage $socialPage)
    {
        return view('social.edit', compact('socialPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\SocialPage $socialPage
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, SocialPage $socialPage)
    {
        $this->authorize('update', $socialPage);

        $request->validate([
            'provider' => 'required|string|unique:social_pages,provider,' . $socialPage->id,
            'link' => 'required|string|unique:social_pages,link,' . $socialPage->id,
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000'
                           ]);

        try {
            if ( $request->image !== null ) $socialPage->icon = $socialPage->updateImage( $request->image, $socialPage->icon, 'webp' );
            $socialPage->provider = $request->provider;
            $socialPage->link = $request->link;
            $socialPage->save();

            session()->flash( 'success', 'Social page updated!' );
            return back();
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to update social page!' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialPage $socialPage
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(SocialPage $socialPage)
    {
        $this->authorize( 'update', $socialPage );

        try {
            $socialPage->delete();

            return response( 'success', 204 );
        } catch ( \Exception $exception ) {
            return response( $exception->getMessage(), 422 );
        }
    }
}
