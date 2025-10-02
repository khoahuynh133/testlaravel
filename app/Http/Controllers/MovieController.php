<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }
    public function nowShowing()
    {
        $movies = Movie::where('status', 'now_showing')->get();
        return view('movies.now-showing', compact('movies'));
    }

    public function comingSoon()
    {
        $movies = Movie::where('status', 'coming_soon')->get();
        return view('movies.coming-soon', compact('movies'));
    }
}
