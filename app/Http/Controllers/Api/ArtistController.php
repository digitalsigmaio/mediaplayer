<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Http\Resources\ArtistResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index()
    {
        if ( $artist = Artist::first() ) return new ArtistResource( $artist );

        return response()->json( [ "data" => null ], 204 );
    }
}
