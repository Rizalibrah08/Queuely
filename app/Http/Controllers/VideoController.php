<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('umkm')->latest()->paginate(10);
        return view('backend.videos.index', compact('videos'));
    }
}
