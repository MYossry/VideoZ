<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index()
    {
        $videos = Video::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('video.home', compact('videos'));
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'max:255',
            'video' => 'required'
        ]);
        $video = $request->video;
        $video->move('videos', time() . $video->getClientOriginalName());


        auth()->user->videos->create([
            'body' => $request->body,
            'video' => 'videos/' . time() . $video->getClientOriginalName(),
        ]);
        return redirect(route('home'));
    }

    public function show(Video $video)
    {
        return view('video.show', compact('video'));
    }

    public function edit(Video $video)
    {
        return view('video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $this->validate($request, [
            'body' => 'max:255',
            'video' => 'required'
        ]);

        $request->video->move('videos', time() . $video->getClientOriginalName());

        $video->body =  $request->body;
        $video->video = 'videos/' . time() . $request->video->getClientOriginalName();
        $video->save();
        return redirect(route('home'));
    }

    public function destroy(Video $video)
    {
        $video . delete();
        return back()->with('success', 'Video Deleted Successfully.');
    }
}
