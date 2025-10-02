@extends('layouts.app')

@section('content')
    <style>
        /* === Banner Carousel: fade mượt + nút đẹp === */
        #bannerCarousel.carousel-fade .carousel-item {
            transition: opacity 1s ease-in-out !important;
        }

        #bannerCarousel .carousel-control-prev,
        #bannerCarousel .carousel-control-next {
            width: auto;
            padding: 0 20px;
        }

        #bannerCarousel .carousel-control-prev-icon,
        #bannerCarousel .carousel-control-next-icon {
            width: 28px;
            height: 28px;
            opacity: 0.9;
            filter: invert(1);
        }

        #bannerCarousel .carousel-control-prev:hover .carousel-control-prev-icon,
        #bannerCarousel .carousel-control-next:hover .carousel-control-next-icon {
            opacity: 1;
        }

        /* === Splide: Tùy chỉnh nút điều hướng (nếu cần) === */
        .splide__arrow {
            background: rgba(0, 0, 0, 0.5) !important;
            width: 36px !important;
            height: 36px !important;
            margin-top: -18px !important;
        }

        .splide__arrow:hover {
            background: rgba(0, 0, 0, 0.8) !important;
        }

        /* === Modal Seat Map === */
        .seat-map {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 5px;
            margin: 20px 0;
        }

        .seat {
            width: 40px;
            height: 40px;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 4px;
            font-size: 12px;
        }

        .seat.available:hover {
            background-color: #90EE90;
        }

        .seat.selected {
            background-color: #32CD32;
        }

        .seat.booked {
            background-color: #ec2f2f;
            cursor: not-allowed;
        }

        /* === Thêm hiệu ứng active cho nút === */
        .btn-active {
            background-color: #007bff !important;
            color: white !important;
            border-color: #007bff !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
        }
    </style>

    <div class="bg-light">
        <!-- 🔹 Banner Carousel (fade mượt) -->
        <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                @foreach ($featuredMovies as $index => $movie)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="d-block w-100"
                            style="height: 500px; background: url('{{ asset($movie->bg_url) }}') center/cover no-repeat;">
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- 🔹 Carousel phim: DÙNG SPLIDE (cuộn từng phim) -->
        <div class="container py-5">
            <h2 class="fw-bold text-center mb-4">🎬 Phim Đang Chiếu</h2>

            <div class="splide" id="moviesSplide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($movies as $movie)
                            <li class="splide__slide px-2">
                                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden position-relative"
                                    style="transition: transform 0.3s, box-shadow 0.3s;"
                                    onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">

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

                                        <span class="position-absolute top-2 start-2 badge bg-danger">ĐANG CHIẾU</span>
                                    </div>

                                    <div class="card-body p-2">
                                        <h6 class="card-title fw-bold text-dark text-truncate"
                                            style="font-size: 0.9rem; line-height: 1.3; height: 1.6rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            {{ $movie->title }}
                                        </h6>
                                        <div class="text-muted small mb-1" style="font-size: 0.8rem;">
                                            <strong>Thể loại:</strong> {{ $movie->category }}
                                        </div>
                                        <div class="text-muted small mb-2" style="font-size: 0.8rem;">
                                            <strong>Ngày chiếu:</strong>
                                            {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}
                                        </div>
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $movie->duration }}
                                        </div>
                                    </div>

                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="background: rgba(0,0,0,0); opacity: 0; transition: opacity 0.3s;"
                                        onmouseover="this.style.opacity='1'; this.style.background='rgba(0,0,0,0.4)';"
                                        onmouseout="this.style.opacity='0'; this.style.background='rgba(0,0,0,0)';">
                                        <!-- Thay đổi nút MUA VÉ để gọi modal -->
                                        <a href="#" class="btn btn-light fw-bold rounded-pill px-4 shadow"
                                            onclick="openBookingModal({{ $movie->movie_id }})">
                                            MUA VÉ
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <!-- ✅ Include Modal -->
    @include('components.booking-modal')

    <!-- ✅ Khởi tạo Splide -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('#moviesSplide', {
                type: 'slide',
                perPage: 3,
                perMove: 1,
                gap: '1rem',
                pagination: false,
                arrows: true,
                drag: 'free',
                breakpoints: {
                    768: {
                        perPage: 2
                    },
                    576: {
                        perPage: 1
                    }
                }
            }).mount();
        });

        let currentMovieId = null;
        let selectedDate = null;
        let selectedTheaterSystemId = null;
        let selectedTheaterId = null;
        let selectedRoomId = null;
        let selectedShowtimeId = null;
        let selectedSeats = [];

        function openBookingModal(movieId) {
            currentMovieId = movieId;
            resetSteps();
            loadAvailableDates(movieId);
            var myModal = new bootstrap.Modal(document.getElementById('bookingModal'));
            myModal.show();
        }

        function resetSteps() {
            selectedDate = null;
            selectedTheaterSystemId = null;
            selectedTheaterId = null;
            selectedRoomId = null;
            selectedShowtimeId = null;
            selectedSeats = [];

            document.getElementById('step1').style.display = 'block';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'none';
            document.getElementById('step4').style.display = 'none';
            document.getElementById('step5').style.display = 'none';
            document.getElementById('step6').style.display = 'none';
            document.getElementById('step7').style.display = 'none';
        }

        function loadAvailableDates(movieId) {
            fetch(`/api/dates/${movieId}`)
                .then(response => response.json())
                .then(data => {
                    const dateList = document.getElementById('date-list');
                    dateList.innerHTML = '';

                    data.dates.forEach(date => {
                        const button = document.createElement('button');
                        button.classList.add('btn', 'btn-outline-primary', 'me-2', 'mb-2');
                        button.textContent = new Date(date).toLocaleDateString('vi-VN');
                        button.onclick = () => {
                            loadShowtimesByDate(date);
                        };
                        dateList.appendChild(button);
                    });
                })
                .catch(error => console.error("Lỗi khi tải danh sách ngày:", error));
        }

        function loadTheaterSystemsByDate(movieId, date) {
            fetch(`/api/theater-systems/${movieId}?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    const theaterSystemList = document.getElementById('theater-system-list');
                    theaterSystemList.innerHTML = '';

                    data.theater_systems.forEach(system => {
                        const button = document.createElement('button');
                        button.classList.add('btn', 'btn-outline-info', 'me-2', 'mb-2');
                        button.textContent = system.name;

                        button.onclick = () => {
                            // Xóa class active khỏi tất cả nút
                            document.querySelectorAll('#theater-system-list .btn').forEach(btn => {
                                btn.classList.remove('btn-active');
                            });

                            // Thêm class active cho nút được chọn
                            button.classList.add('btn-active');

                            selectedTheaterSystemId = system.theater_systems_id;
                            document.getElementById('next-to-theater').disabled = false;
                        };

                        theaterSystemList.appendChild(button);
                    });

                    document.getElementById('next-to-theater').disabled = false;
                })
                .catch(error => console.error("Lỗi khi tải hệ thống rạp:", error));
        }

        function loadShowtimesByDate(date) {
            fetch(`/api/showtimes/${currentMovieId}?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    // Hiện bước chọn hệ thống rạp
                    document.getElementById('step1').style.display = 'none';
                    document.getElementById('step2').style.display = 'block';

                    selectedDate = date;

                    // Gọi API hệ thống rạp
                    loadTheaterSystemsByDate(currentMovieId, date);
                })
                .catch(error => console.error("Lỗi khi tải suất chiếu:", error));
        }

        // === Thêm tất cả sự kiện vào 1 DOMContentLoaded ===
        document.addEventListener('DOMContentLoaded', function() {
            // Các sự kiện cho nút
            document.getElementById('next-to-theater').addEventListener('click', () => {
                if (!selectedTheaterSystemId) return;
                loadTheatersBySystem(selectedTheaterSystemId);
                document.getElementById('step2').style.display = 'none';
                document.getElementById('step3').style.display = 'block';
            });

            document.getElementById('next-to-room').addEventListener('click', () => {
                if (!selectedTheaterId) return;
                loadRoomsByTheater(selectedTheaterId);
                document.getElementById('step3').style.display = 'none';
                document.getElementById('step4').style.display = 'block';
            });

            document.getElementById('next-to-showtime').addEventListener('click', () => {
                if (!selectedRoomId) return;
                loadShowtimesByRoomAndDate(selectedRoomId, selectedDate);
                document.getElementById('step4').style.display = 'none';
                document.getElementById('step5').style.display = 'block';
            });

            document.getElementById('next-to-seat').addEventListener('click', () => {
                if (!selectedShowtimeId) return;

                loadSeats(currentMovieId, selectedShowtimeId); // ✅ Đảm bảo truyền đúng showtime_id
                document.getElementById('step5').style.display = 'none';
                document.getElementById('step6').style.display = 'block';
            });

            document.getElementById('next-to-info').addEventListener('click', () => {
                if (selectedSeats.length === 0) {
                    alert('Vui lòng chọn ít nhất một ghế!');
                    return;
                }
                document.getElementById('step6').style.display = 'none';
                document.getElementById('step7').style.display = 'block';
            });

            document.getElementById('back-to-showtime').addEventListener('click', () => {
                document.getElementById('step6').style.display = 'none';
                document.getElementById('step5').style.display = 'block';
            });

            document.getElementById('back-to-room').addEventListener('click', () => {
                document.getElementById('step5').style.display = 'none';
                document.getElementById('step4').style.display = 'block';
            });

            document.getElementById('back-to-theater').addEventListener('click', () => {
                document.getElementById('step4').style.display = 'none';
                document.getElementById('step3').style.display = 'block';
            });

            document.getElementById('back-to-theater-system').addEventListener('click', () => {
                document.getElementById('step3').style.display = 'none';
                document.getElementById('step2').style.display = 'block';
            });

            document.getElementById('back-to-date').addEventListener('click', () => {
                document.getElementById('step2').style.display = 'none';
                document.getElementById('step1').style.display = 'block';
            });
        });

        // === Các hàm load còn lại ===
        function loadTheatersBySystem(theaterSystemId) {
            fetch(`/api/theaters/${theaterSystemId}`)
                .then(response => response.json())
                .then(data => {
                    const theaterList = document.getElementById('theater-list');
                    theaterList.innerHTML = '';

                    data.theaters.forEach(theater => {
                        const button = document.createElement('button');
                        button.classList.add('btn', 'btn-outline-warning', 'me-2', 'mb-2');
                        button.textContent = theater.name;

                        button.onclick = () => {
                            // Xóa class active khỏi tất cả nút
                            document.querySelectorAll('#theater-list .btn').forEach(btn => {
                                btn.classList.remove('btn-active');
                            });

                            // Thêm class active cho nút được chọn
                            button.classList.add('btn-active');

                            selectedTheaterId = theater.theater_id;
                            document.getElementById('next-to-room').disabled = false;
                        };

                        theaterList.appendChild(button);
                    });

                    document.getElementById('next-to-room').disabled = false;
                })
                .catch(error => console.error("Lỗi khi tải rạp:", error));
        }

        function loadRoomsByTheater(theaterId) {
            fetch(`/api/rooms/${theaterId}`)
                .then(response => response.json())
                .then(data => {
                    const roomList = document.getElementById('room-list');
                    roomList.innerHTML = '';

                    data.rooms.forEach(room => {
                        const button = document.createElement('button');
                        button.classList.add('btn', 'btn-outline-success', 'me-2', 'mb-2');
                        button.textContent = room.name;

                        button.onclick = () => {
                            // Xóa class active khỏi tất cả nút
                            document.querySelectorAll('#room-list .btn').forEach(btn => {
                                btn.classList.remove('btn-active');
                            });

                            // Thêm class active cho nút được chọn
                            button.classList.add('btn-active');

                            selectedRoomId = room.room_id;
                            document.getElementById('next-to-showtime').disabled = false;
                        };

                        roomList.appendChild(button);
                    });

                    document.getElementById('next-to-showtime').disabled = false;
                })
                .catch(error => console.error("Lỗi khi tải phòng:", error));
        }

        function loadShowtimesByRoomAndDate(roomId, date) {
            fetch(`/api/showtimes-by-room/${roomId}?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    const showtimeList = document.getElementById('showtime-list');
                    showtimeList.innerHTML = '';

                    if (data.showtimes.length === 0) {
                        showtimeList.innerHTML =
                            '<p class="text-danger">Không có suất chiếu nào trong ngày này cho phòng này.</p>';
                        document.getElementById('next-to-seat').disabled = true;
                        return;
                    }

                    data.showtimes.forEach(showtime => {
                        const button = document.createElement('button');
                        button.classList.add('btn', 'btn-outline-secondary', 'me-2', 'mb-2');
                        button.textContent = new Date(showtime.start_time).toLocaleTimeString('vi-VN', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        button.onclick = () => {
                            // Xóa class active khỏi tất cả nút
                            document.querySelectorAll('#showtime-list .btn').forEach(btn => {
                                btn.classList.remove('btn-active');
                            });

                            // Thêm class active cho nút được chọn
                            button.classList.add('btn-active');

                            selectedShowtimeId = showtime.showtime_id;
                            document.getElementById('next-to-seat').disabled = false;
                        };

                        showtimeList.appendChild(button);
                    });

                    document.getElementById('next-to-seat').disabled = false;
                })
                .catch(error => console.error("Lỗi khi tải suất chiếu:", error));
        }

        function loadSeats(movieId, showtimeId) {
            fetch(`/api/seats/${movieId}/${showtimeId}`)
                .then(response => response.json())
                .then(data => {
                    renderSeats(data.seats);
                })
                .catch(error => console.error("Lỗi khi tải dữ liệu ghế:", error));
        }

        function renderSeats(seats) {
            const seatMap = document.querySelector('.seat-map');
            seatMap.innerHTML = '';

            seats.forEach(seat => {
                const seatEl = document.createElement('div');
                seatEl.classList.add('seat');
                seatEl.textContent = seat.number;
                seatEl.dataset.id = seat.id;
                seatEl.dataset.price = seat.price;

                if (seat.status === 'booked') {
                    seatEl.classList.add('booked');
                } else {
                    seatEl.classList.add('available');
                    seatEl.addEventListener('click', () => toggleSeat(seat.id, seat.number, seat.price));
                }

                seatMap.appendChild(seatEl);
            });
        }

        function toggleSeat(id, number, price) {
            const index = selectedSeats.findIndex(item => item.id === id);

            if (index > -1) {
                selectedSeats.splice(index, 1);
            } else {
                selectedSeats.push({
                    id,
                    number,
                    price
                }); // ✅ Lưu cả price
            }

            updateSelectedSeatsDisplay();
            updateSeatDisplay();
        }

        function updateSelectedSeatsDisplay() {
            const seatList = selectedSeats.map(seat => `${seat.number}`);
            document.getElementById('selected-seats').textContent = seatList;

            // Tính tổng tiền
            const totalPrice = selectedSeats.reduce((sum, seat) => sum + seat.price, 0);
            document.getElementById('total-price').textContent = totalPrice.toLocaleString() + 'đ';
        }

        document.getElementById('booking-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const data = {
                full_name: document.getElementById('full_name').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                payment_method: document.getElementById('payment_method').value,
                seat_ids: selectedSeats,
                movie_id: currentMovieId,
                showtime_id: selectedShowtimeId,
            };

            try {
                const response = await fetch('/api/book-ticket', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    alert('Đặt vé thành công!');
                    bootstrap.Modal.getInstance(document.getElementById('bookingModal')).hide();
                } else {
                    alert('Có lỗi xảy ra khi đặt vé.');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
@endsection
