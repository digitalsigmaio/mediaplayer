<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
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
        return view( 'posts.index', [ 'posts' => Post::latest()->get() ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'posts.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Post $post)
    {
        $this->authorize( 'update', $post );

        $request->validate( [ 'title' => 'required|max:100|unique:posts',
                              'body' => 'required',
                              'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000' // max 10000 kb
                            ] );


        try {
            $post->image = Post::uploadImage( $request->image, 'webp' );
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            if ($request->has('notify') && $request->notify) {
                broadcast(new NewPost($post))->toOthers();
            }

            session()->flash( 'success', 'Post created!' );
            return redirect()->route( 'posts.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to create post!' );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view( 'posts.edit', compact( 'post' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize( 'update', $post );

        $request->validate( [ 'title' => 'required|max:100|unique:posts,title,' . $post->id,
                              'body' => 'required',
                              'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000' // max 10000 kb
                            ] );


        try {
            if ( $request->image !== null ) $post->image = Post::updateImage( $request->image, $post->image, 'webp' );
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            session()->flash( 'success', 'Post updated!' );
            return redirect()->route( 'posts.index' );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );
            return back()->withError( 'Failed to update post!' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy( Post $post )
    {
        $this->authorize( 'update', $post );

        try {
            $post->delete();

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
        return view( 'posts.trash', [ 'posts' => Post::onlyTrashed()->get() ] );
    }


    /**
     * @param int $postId
     *
     * @return Response
     */
    public function restore( int $postId ): Response
    {
        try {
            Post::onlyTrashed()->whereId( $postId )->first()->restore();

            return \response( 'Post restored!', 200 );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage());
            return response( 'Failed to restore post', 422 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $postId
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyForever( int $postId )
    {
        $post = Post::onlyTrashed()->whereId( $postId )->first();

        $this->authorize( 'update', $post );

        try {
            $post->forceDelete();

            return response( 'success', 204 );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage());
            return response( 'Error while deleting the post permanently', 422 );
        }
    }
}
