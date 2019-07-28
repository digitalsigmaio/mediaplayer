<?php

namespace App\Http\Controllers\Api;

use App\GalleryImage;
use App\Http\Resources\GalleryImageResource;
use App\Http\Controllers\Controller;

class GalleryImageController extends Controller
{
    public function index()
    {
        return GalleryImageResource::collection(GalleryImage::latest()->paginate(10));
    }

    public function show(GalleryImage $image)
    {
        return new GalleryImageResource($image);
    }
}
