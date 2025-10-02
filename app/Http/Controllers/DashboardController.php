<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $featuredMovies = Movie::where('status', 'now_showing')
            ->orderBy('release_date', 'desc')
            ->take(5)
            ->get();

        $latestMovies = Movie::orderBy('release_date', 'desc')
            ->take(10)
            ->get();

        // Thêm biến $movies cho phim sắp chiếu
        $movies = Movie::where('status', 'coming_soon')
            ->orderBy('release_date', 'asc')
            ->take(10)
            ->get();

        return view('dashboard', compact('featuredMovies', 'latestMovies', 'movies'));
    }
}
