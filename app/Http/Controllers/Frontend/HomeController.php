<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $slides = [
            ['image' => 'assets/img/khe-uoc-co-dau/khe-uoc-co-dau-bg.jpg'],
            ['image' => 'assets/img/lam-giau-voi-ma/lam-giau-voi-ma-bg.jpg'],
            ['image' => 'assets/img/mua-do/mua-do-bg.jpg'],
            // Thêm slide khác nếu muốn
        ];

        $movies = Movie::where('status', 'now_showing') // hoặc 'active', tùy logic bạn định nghĩa
            ->orderBy('title')
            ->get(['movie_id', 'title']);

        return view('frontend.home', compact('slides', 'movies'));
    }
}
