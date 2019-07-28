<?php

namespace App\Http\Controllers\Api;

use App\Video;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {
        return Video::paginate(20);
    }

    public function show(Video $video)
    {
        return response()->json(['data' => $video]);
    }
}
