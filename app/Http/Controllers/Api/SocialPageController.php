<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SocialPageResource;
use App\SocialPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialPageController extends Controller
{
    public function index()
    {
        return SocialPageResource::collection(SocialPage::all());
    }

    public function show(Request $request, SocialPage $socialPage)
    {
        return new SocialPageResource($socialPage);
    }
}
