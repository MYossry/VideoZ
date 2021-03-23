<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return true;
        $videos = Video::with('user')
        ->orderBy('created_at','desc')
        ->paginate(20);
        return view('dashboard',compact('videos'));
    }
}
