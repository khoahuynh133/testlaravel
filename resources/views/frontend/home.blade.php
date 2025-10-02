@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <!-- HERO SLIDER -->
    <div id="heroSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($slides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="d-block w-100 hero-slide"
                        style="background-image: url('{{ asset($slide['image']) }}'); height: 80vh;">
                        <div class="carousel-caption d-none d-md-block" data-aos="fade-up" data-aos-duration="1000">
                            <a href="#" class="btn btn-primary">Đặt vé ngay</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- QUICK BOOKING -->
    <section class="py-5 mt-5 shadow-lg" data-aos="zoom-in" data-aos-duration="800">
        <div class="container">
            <h2 class="text-center fw-bold mb-4 text-light">🎬 Đặt vé nhanh</h2>
            <form class="row g-3 justify-content-center">
                <div class="col-md-2">
                    <label class="form-label text-light">Chọn Phim</label>
                    <div class="col-md-2">
                        <label class="form-label text-light">Chọn Phim</label>
                        <select class="form-select" name="movie_id" required>
                            <option value="">-- Chọn phim --</option>
                            @foreach ($movies as $movie)
                                <option value="{{ $movie->movie_id }}">{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label text-light">Chọn Rạp</label>
                    <select class="form-select">
                        <option>CGV</option>
                        <option>GALAXY CINEMA</option>
                        <option>LOTTE CINEMA</option>
                        <option>BHD STAR</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label text-light">Chọn Ngày</label>
                    <select class="form-select">
                        <option>17/09/2025</option>
                        <option>18/09/2025</option>
                        <option>19/09/2025</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label text-light">Chọn Suất</label>
                    <select class="form-select">
                        <option>09:00</option>
                        <option>13:30</option>
                        <option>19:00</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Mua vé nhanh</button>
                </div>
            </form>
        </div>
    </section>
@endsection
