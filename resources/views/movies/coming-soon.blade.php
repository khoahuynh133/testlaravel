@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">
            <!-- Tiêu đề -->
            <div class="text-center mb-5">
                <h1 class="fw-bold display-5 text-dark">
                    PHIM SẮP CHIẾU
                </h1>
                <div class="mx-auto" style="width: 60px; height: 3px; background-color: #ffc107; border-radius: 2px;">
                </div>
                <p class="mt-3 text-muted w-75 mx-auto">
                    Khám phá những bộ phim hấp dẫn sắp ra rạp.
                </p>
            </div>

            <!-- Danh sách phim -->
            @if ($movies->isEmpty())
                <div class="text-center py-5">
                    <div class="text-secondary mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                            class="bi bi-film" viewBox="0 0 16 16">
                            <path
                                d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h2V1H4zm3 0v6h2V1H7zm3 0v6h2V1h-2zM0 8v6h2V8H0zm3 0v6h2V8H3zm3 0v6h2V8H6zm3 0v6h2V8H9zm3 0v6h2V8h-2z" />
                        </svg>
                    </div>
                    <h3 class="h5">Chưa có phim sắp chiếu nào</h3>
                    <p class="text-muted mt-2">Hãy quay lại sau hoặc xem các phim đang chiếu!</p>
                    <a href="{{ route('movies.now-showing') }}" class="btn btn-warning mt-3 px-4">
                        Xem phim đang chiếu
                    </a>
                </div>
            @else
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4 ">
                    @foreach ($movies as $movie)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden position-relative"
                                style="transition: transform 0.3s, box-shadow 0.3s;"
                                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">

                                <!-- Poster -->
                                <div class="position-relative" style="padding-bottom: 150%; background-color: #f8f9fa;">
                                    @if ($movie->poster_url)
                                        <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}"
                                            class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                                    @else
                                        <div
                                            class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-secondary bg-light">
                                            <small>Không có poster</small>
                                        </div>
                                    @endif

                                    <!-- Nhãn trạng thái -->
                                    <span class="position-absolute top-2 start-2 badge bg-warning text-dark">
                                        SẮP CHIẾU
                                    </span>
                                </div>

                                <!-- Thân card -->
                                <div class="card-body p-2">
                                    <h6 class="card-title fw-bold text-dark text-truncate"
                                        style="font-size: 0.9rem; line-height: 1.3; height: 1.6rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $movie->title }}
                                    </h6>

                                    <!-- Danh mục -->
                                    <div class="text-muted small mb-1" style="font-size: 0.8rem;">
                                        <strong>Thể loại:</strong> {{ $movie->category }}
                                    </div>

                                    <!-- Ngày phát hành -->
                                    <div class="text-muted small mb-2" style="font-size: 0.8rem;">
                                        <strong>Ngày chiếu:</strong>
                                        {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}
                                    </div>

                                    <!-- Thời lượng -->
                                    <div class="d-flex align-items-center text-muted small">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                        </svg>
                                        {{ $movie->duration }}
                                    </div>
                                </div>

                                <!-- Nút XEM CHI TIẾT (ẩn/mở khi hover) -->
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                    style="background: rgba(0,0,0,0); opacity: 0; transition: opacity 0.3s, background 0.3s;"
                                    onmouseover="this.style.opacity='1'; this.style.background='rgba(0,0,0,0.4)';"
                                    onmouseout="this.style.opacity='0'; this.style.background='rgba(0,0,0,0)';">
                                    <a href="{{ route('movies.show', $movie->movie_id) }}"
                                        class="btn btn-light fw-bold rounded-pill px-4 shadow">
                                        XEM CHI TIẾT
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
