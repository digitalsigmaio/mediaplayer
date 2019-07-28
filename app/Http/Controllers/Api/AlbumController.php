<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Resources\AlbumResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index()
    {
        return AlbumResource::collection(Album::orderBy('year', 'desc')->paginate(10));
    }

    public function show(Album $album)
    {
        $album->load('tracks');

        return new AlbumResource($album);
    }
}
