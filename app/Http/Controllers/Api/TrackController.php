<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TrackResource;
use App\Track;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Zend\Diactoros\Request;

class TrackController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        if (\request()->has('q')) {
            $q =\request('q');

            if (! $q) {
                return response('Query search can not be null', 422);
            }

            $tracks = Track::where( 'title', 'like', "%{$q}%" )->latest()->paginate(20);
        } else {
            $tracks = Track::latest()->paginate(20);
        }

        return TrackResource::collection($tracks);
    }

    public function show(Track $track)
    {
        $track->recordView(auth('api')->id());
        return new TrackResource($track);
    }
}
