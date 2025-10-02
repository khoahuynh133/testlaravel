@extends('layouts.app')

@section('title', 'Phim sắp chiếu')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-info fw-bold">🎥 Phim sắp chiếu</h2>

    <div class="row">
        @forelse($comingSoon as $movie)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($movie['poster']) }}" class="card-img-top" alt="{{ $movie['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $movie['title'] }}</h5>
                        <p class="card-text small text-muted">
                            Khởi chiếu: {{ $movie['release_date'] ?? 'Chưa cập nhật' }}
                        </p>
                        <a href="{{ route('movies.show', $movie['id']) }}" class="btn btn-outline-info btn-sm w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Hiện tại chưa có thông tin phim sắp chiếu.</p>
        @endforelse
    </div>
</div>
@endsection
