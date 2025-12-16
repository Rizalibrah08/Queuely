<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmVideoController extends Controller
{
    public function index()
    {
        $umkm = Auth::user()->umkm;
        $videos = $umkm->videos()->latest()->get();
        return view('backend.umkm.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('backend.umkm.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:51200', // Max 50MB
            'caption' => 'nullable|string|max:255',
        ]);

        $umkm = Auth::user()->umkm;

        $path = $request->file('video')->store('videos', 'public');

        Video::create([
            'umkm_id' => $umkm->id,
            'caption' => $request->caption,
            'video_path' => $path,
        ]);

        return redirect()->route('umkm.videos.index')->with('success', 'Video berhasil diupload');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->umkm_id !== Auth::user()->umkm->id) {
            abort(403);
        }

        if (Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->delete();

        return redirect()->route('umkm.videos.index')->with('success', 'Video berhasil dihapus');
    }
}
