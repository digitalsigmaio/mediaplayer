<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::latest()->paginate(10));
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }
}
