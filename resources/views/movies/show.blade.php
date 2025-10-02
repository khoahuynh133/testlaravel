@extends('layouts.app')

@section('content')
<div class="position-relative">
    <!-- Background -->
    <div class="position-relative w-100" style="height: 400px; overflow: hidden;">
        @if($movie->bg_url)
            <img src="{{ asset($movie->bg_url) }}" alt="{{ $movie->title }}" class="w-100 h-100 object-fit-cover" style="filter: brightness(0.5);">
        @endif
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center text-white px-4">
            <h1 class="display-4 fw-bold">{{ $movie->title }}</h1>
            <p class="lead">{{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }} | {{ $movie->category }} | {{ $movie->duration }} phút</p>
            <div class="mt-3">
                <a href="#trailer" class="btn btn-outline-light btn-lg me-2">Xem Trailer</a>
                <a href="#book" class="btn btn-danger btn-lg">Mua Vé</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row g-5">
            <!-- Poster -->
            <div class="col-lg-4">
                <div class="card border-0 shadow">
                    @if($movie->poster_url)
                        <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}" class="card-img-top rounded">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                            <span class="text-muted">Không có poster</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Movie Info -->
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Thông Tin Phim</h2>
                <p class="text-muted">{{ $movie->description }}</p>

                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><strong>Thể loại:</strong> {{ $movie->category }}</li>
                    <li class="mb-2"><strong>Diễn viên:</strong> {{ $movie->actor }}</li>
                    <li class="mb-2"><strong>Đạo diễn:</strong> {{ $movie->diretor }}</li>
                    <li class="mb-2"><strong>Quốc gia:</strong> {{ $movie->country }}</li>
                    <li class="mb-2"><strong>Thời lượng:</strong> {{ $movie->duration }} phút</li>
                    <li class="mb-2"><strong>Ngày chiếu:</strong> {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</li>
                </ul>

                <!-- Trailer -->
                @if($movie->trailer_url)
                    <div id="trailer" class="my-4">
                        <h4 class="fw-bold mb-3">Trailer</h4>
                        <div class="ratio ratio-16x9 shadow rounded">
                            <iframe src="{{ $movie->trailer_url }}" title="Trailer {{ $movie->title }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                <!-- Nút Mua Vé -->
                <div id="book" class="mt-4">
                    <a href="{{ route('movies.now-showing') }}" class="btn btn-danger btn-lg shadow">Mua Vé Ngay</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Background Blur Effect Footer -->
    <div class="position-relative" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,0.1), transparent);"></div>
</div>
@endsection
