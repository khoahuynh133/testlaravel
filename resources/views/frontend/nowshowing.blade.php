@extends('layouts.app')

@section('title', 'Phim đang chiếu')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-warning fw-bold">🎬 Phim đang chiếu</h2>

    <div class="row">
        @forelse($nowShowing as $movie)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($movie['poster']) }}" class="card-img-top" alt="{{ $movie['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $movie['title'] }}</h5>
                        <p class="card-text small text-muted">
                            Thời lượng: {{ $movie['duration'] ?? 'N/A' }} phút
                        </p>
                        <a href="{{ route('movies.show', $movie['id']) }}" class="btn btn-primary btn-sm w-100">
                            Đặt vé ngay
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Hiện tại chưa có phim nào đang chiếu.</p>
        @endforelse
    </div>
</div>
@endsection
