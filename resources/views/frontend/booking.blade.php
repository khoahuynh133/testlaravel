<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xem Phim - TVCinema</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>

<body>

    @include('frontend.header')

    <div class="booking-container">
        <!-- Stepper -->
        <div class="stepper">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-title">Chọn Suất</div>
            </div>
            <div class="step-divider"></div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-title">Chọn Ghế</div>
            </div>
            <div class="step-divider"></div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-title">Thanh Toán</div>
            </div>
        </div>

        <div class="booking-body">
            <!-- Cột trái: Nội dung các bước -->
            <div class="booking-content">
                <!-- BƯỚC 1: CHỌN RẠP, PHIM, SUẤT -->
                <div class="booking-step-content active" data-content="1">
                    <h2 class="step-content-title">Chọn suất chiếu</h2>
                    <div class="selection-grid">
                        <div class="form-group">
                            <label for="theater-select">1. Chọn Rạp/Vị trí</label>
                            <select id="theater-select" class="form-control">
                                <option value="" disabled selected>-- Vui lòng chọn rạp --</option>
                                <!-- JS sẽ load các rạp từ API -->
                            </select>
                        </div>

                        <div class="form-group" id="movie-selection" style="display: none;">
                            <label for="movie-select">2. Chọn Phim</label>
                            <select id="movie-select" class="form-control">
                                <!-- Các phim sẽ được load bằng JS -->
                            </select>
                        </div>

                        <div class="form-group" id="showtime-selection" style="display: none;">
                            <label>3. Chọn Suất Chiếu</label>
                            <div class="date-tabs">
                                <!-- JS sẽ load ngày từ API -->
                            </div>
                            <div class="time-slots">
                                <!-- JS sẽ load giờ từ API -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 2: CHỌN GHẾ -->
                <div class="booking-step-content" data-content="2">
                    <div class="seat-selection-header">
                        <h2 class="step-content-title">Chọn ghế</h2>
                        <button class="change-showtime-btn">Đổi suất chiếu</button>
                    </div>
                    <div class="seat-map-container">
                        <div class="screen">MÀN HÌNH</div>
                        <div class="seat-map">
                            <!-- Ghế sẽ được render bằng JS -->
                        </div>
                        <div class="seat-legend">
                            <div class="legend-item">
                                <div class="seat-example seat-regular"></div> Ghế thường
                            </div>
                            <div class="legend-item">
                                <div class="seat-example seat-vip"></div> Ghế VIP
                            </div>
                            <div class="legend-item">
                                <div class="seat-example seat-selected"></div> Ghế bạn chọn
                            </div>
                            <div class="legend-item">
                                <div class="seat-example seat-occupied"></div> Ghế đã bán
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BƯỚC 3: THANH TOÁN -->
                <div class="booking-step-content" data-content="3">
                    <h2 class="step-content-title">Xác nhận và Thanh toán</h2>
                    <div class="payment-summary">
                        <h3>Thông tin đặt vé</h3>
                        <p><strong>Phim:</strong> <span id="payment-movie-title"></span></p>
                        <p><strong>Rạp:</strong> <span id="payment-theater"></span></p>
                        <p><strong>Suất chiếu:</strong> <span id="payment-showtime"></span></p>
                        <p><strong>Ghế:</strong> <span id="payment-seats"></span></p>
                        <p><strong>Tổng cộng:</strong> <span id="payment-total" class="total-price"></span></p>
                        <hr>
                        <h3>Phương thức thanh toán</h3>
                        <div class="payment-methods">
                            <label><input type="radio" name="payment" checked> Thanh toán tại quầy</label>
                            <label><input type="radio" name="payment"> Ví MoMo</label>
                            <label><input type="radio" name="payment"> Thẻ ngân hàng</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Tóm tắt thông tin -->
            <div class="booking-summary">
                <h3 class="summary-title">Thông Tin Vé</h3>
                <div class="summary-content">
                    <img src="https://via.placeholder.com/200x300" alt="Poster phim" id="summary-poster"
                        class="summary-poster">
                    <h4 id="summary-movie-title">Vui lòng chọn phim</h4>
                    <p><i class='bx bx-location-plus'></i> <span id="summary-theater">...</span></p>
                    <p><i class='bx bx-calendar'></i> <span id="summary-date">...</span></p>
                    <p><i class='bx bx-time'></i> <span id="summary-time">...</span></p>

                    <div class="summary-details" id="summary-seat-info" style="display: none;">
                        <hr>
                        <p><i class='bx bx-chair'></i> Ghế: <span id="summary-seats"></span></p>
                        <p>Tổng cộng: <span id="summary-total" class="total-price">0đ</span></p>
                    </div>
                </div>
                <div class="summary-actions">
                    <button class="btn-secondary" id="back-btn" style="display: none;">Quay Lại</button>
                    <button class="btn-primary" id="next-btn" disabled>Tiếp Tục</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async function() { // ✅ thêm async
            let currentStep = 1;
            const bookingData = {
                theater: null,
                theater_id: null,
                movie: null,
                movie_id: null,
                date: null,
                time: null,
                showtime_id: null,
                seats: [],
                total: 0
            };

            const steps = document.querySelectorAll('.step');
            const stepContents = document.querySelectorAll('.booking-step-content');
            const nextBtn = document.getElementById('next-btn');
            const backBtn = document.getElementById('back-btn');
            const theaterSelect = document.getElementById('theater-select');
            const movieSelect = document.getElementById('movie-select');
            const movieSelection = document.getElementById('movie-selection');
            const showtimeSelection = document.getElementById('showtime-selection');
            const dateTabsContainer = showtimeSelection.querySelector('.date-tabs');
            const timeSlotsContainer = showtimeSelection.querySelector('.time-slots');
            const seatMapContainer = document.querySelector('.seat-map');
            const changeShowtimeBtn = document.querySelector('.change-showtime-btn');

            function updateUI() {
                steps.forEach(s => s.classList.toggle('active', parseInt(s.dataset.step) === currentStep));
                stepContents.forEach(c => c.classList.toggle('active', parseInt(c.dataset.content) ===
                    currentStep));
                backBtn.style.display = currentStep > 1 ? 'inline-block' : 'none';
                nextBtn.textContent = currentStep === 3 ? 'Xác Nhận Thanh Toán' : 'Tiếp Tục';
                updateNextButtonState();
            }

            function updateNextButtonState() {
                let enabled = false;
                if (currentStep === 1 && bookingData.theater_id && bookingData.movie_id && bookingData.date &&
                    bookingData.time) enabled = true;
                else if (currentStep === 2 && bookingData.seats.length > 0) enabled = true;
                else if (currentStep === 3) enabled = true;
                nextBtn.disabled = !enabled;
            }

            function groupShowtimesByDate(showtimes) {
                const grouped = {};
                showtimes.forEach(st => {
                    // fallback ngày hôm nay nếu show_date null
                    const date = st.show_date || new Date().toISOString().split('T')[0];
                    if (!grouped[date]) grouped[date] = [];
                    grouped[date].push(st);
                });
                return {
                    dates: Object.keys(grouped),
                    showtimes: grouped
                };
            }

            function updateSummary() {
                document.getElementById('summary-movie-title').textContent = bookingData.movie ||
                    'Vui lòng chọn phim';
                document.getElementById('summary-theater').textContent = bookingData.theater || '...';
                document.getElementById('summary-date').textContent = bookingData.date || '...';
                document.getElementById('summary-time').textContent = bookingData.time || '...';
                document.getElementById('summary-seats').textContent = bookingData.seats.join(', ');
                document.getElementById('summary-total').textContent = bookingData.total.toLocaleString(
                    'vi-VN') + 'đ';
                document.getElementById('payment-movie-title').textContent = bookingData.movie || '';
                document.getElementById('payment-theater').textContent = bookingData.theater || '';
                document.getElementById('payment-showtime').textContent = bookingData.date && bookingData.time ?
                    bookingData.date + ' ' + bookingData.time : '';
                document.getElementById('payment-seats').textContent = bookingData.seats.join(', ');
                document.getElementById('payment-total').textContent = bookingData.total.toLocaleString(
                    'vi-VN') + 'đ';
            }

            theaterSelect.addEventListener('change', async function() {
                const theaterId = this.value;
                if (!theaterId) return;
                bookingData.theater = this.options[this.selectedIndex].text;
                bookingData.theater_id = theaterId;
                bookingData.movie = bookingData.movie_id = null;
                bookingData.date = bookingData.time = bookingData.showtime_id = null;
                movieSelect.innerHTML = '';
                try {
                    const res = await fetch(`/api/movies?theater_id=${theaterId}`);
                    const movies = await res.json();
                    movieSelect.innerHTML =
                        `<option disabled selected>-- Vui lòng chọn phim --</option>`;
                    movies.forEach(m => {
                        const opt = document.createElement('option');
                        opt.value = m.movie_id;
                        opt.textContent = m.title;
                        movieSelect.appendChild(opt);
                    });
                    movieSelection.style.display = 'block';
                    showtimeSelection.style.display = 'none';
                    updateSummary();
                    updateNextButtonState();
                } catch (e) {
                    console.error(e);
                }
            });

            movieSelect.addEventListener('change', function() {
                bookingData.movie_id = this.value;
                bookingData.movie = this.options[this.selectedIndex].text;
                bookingData.date = bookingData.time = bookingData.showtime_id = null;
                showtimeSelection.style.display = 'block';
                loadShowtimes();
                updateSummary();
                updateNextButtonState();
            });

            async function loadShowtimes() {
                if (!bookingData.theater_id || !bookingData.movie_id) return;
                try {
                    const res = await fetch(
                        `/api/showtimes?theater_id=${bookingData.theater_id}&movie_id=${bookingData.movie_id}`
                    );
                    const rawData = await res.json(); // array showtimes
                    const data = groupShowtimesByDate(rawData); // {dates: [...], showtimes: {date: [...]}}

                    dateTabsContainer.innerHTML = '';
                    data.dates.forEach((d, i) => {
                        const btn = document.createElement('button');
                        btn.className = 'date-tab' + (i === 0 ? ' active' : '');
                        btn.dataset.date = d;
                        btn.textContent = new Date(d).toLocaleDateString('vi-VN', {
                            weekday: 'long',
                            day: '2-digit',
                            month: '2-digit'
                        });
                        dateTabsContainer.appendChild(btn);
                    });
                    attachDateEvents(data.showtimes);
                    renderTimeSlots(data.showtimes[data.dates[0]] || []);
                } catch (e) {
                    console.error(e);
                }
            }


            function attachDateEvents(showtimesData) {
                const tabs = dateTabsContainer.querySelectorAll('.date-tab');
                tabs.forEach(tab => tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    bookingData.date = this.dataset.date;
                    bookingData.time = bookingData.showtime_id = null;
                    renderTimeSlots(showtimesData[bookingData.date] || []);
                    updateSummary();
                    updateNextButtonState();
                }));
                bookingData.date = tabs[0]?.dataset.date || null;
            }

            function renderTimeSlots(slots) {
                timeSlotsContainer.innerHTML = '';
                slots.forEach(s => {
                    const btn = document.createElement('button');
                    btn.className = 'time-slot';
                    btn.dataset.showtimeId = s.showtime_id;
                    btn.dataset.time = s.start_time;
                    btn.textContent = s.start_time;
                    timeSlotsContainer.appendChild(btn);
                });
                attachTimeSlotEvents();
            }

            function attachTimeSlotEvents() {
                const timeSlots = timeSlotsContainer.querySelectorAll('.time-slot');
                timeSlots.forEach(btn => btn.addEventListener('click', function() {
                    timeSlots.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    bookingData.time = this.dataset.time;
                    bookingData.showtime_id = this.dataset.showtimeId;
                    bookingData.seats = [];
                    bookingData.total = 0;
                    renderSeatMap();
                    updateSummary();
                    updateNextButtonState();
                }));
            }

            async function loadTheaters() {
                try {
                    const res = await fetch('/api/theaters');
                    const theaters = await res.json();
                    theaters.forEach(t => {
                        const opt = document.createElement('option');
                        opt.value = t.theater_id;
                        opt.textContent = t.name;
                        theaterSelect.appendChild(opt);
                    });
                } catch (e) {
                    console.error('Không thể load rạp:', e);
                }
            }

            async function renderSeatMap() {
                if (!bookingData.showtime_id) return;
                try {
                    const res = await fetch(`/api/seats?showtime_id=${bookingData.showtime_id}`);
                    const seats = await res.json();
                    seatMapContainer.innerHTML = '';
                    seats.forEach(seat => {
                        const div = document.createElement('div');
                        div.classList.add('seat');
                        div.dataset.id = seat.seat_id; // seat_id từ API, chắc chắn là int

                        div.dataset.price = seat.price;
                        div.textContent = seat.seat_number.match(/\d+$/)[0];
                        div.classList.add(seat.seat_type === 'vip' ? 'seat-vip' : 'seat-regular');
                        if (seat.occupied) div.classList.add('seat-occupied');
                        seatMapContainer.appendChild(div);
                    });
                    attachSeatEvents();
                } catch (e) {
                    console.error(e);
                }
            }

            function attachSeatEvents() {
                seatMapContainer.querySelectorAll('.seat').forEach(seat => {
                    seat.addEventListener('click', function() {
                        if (seat.classList.contains('seat-occupied')) return;
                        seat.classList.toggle('seat-selected');
                        const seatId = seat.dataset.id; // phải có giá trị
                        const price = parseInt(seat.dataset.price);

                        if (!seatId) return; // <--- thêm check
                        if (seat.classList.contains('seat-selected')) {
                            bookingData.seats.push(seatId);
                            bookingData.total += price;
                        } else {
                            bookingData.seats = bookingData.seats.filter(s => s !== seatId);
                            bookingData.total -= price;
                        }
                        updateSummary();
                        updateNextButtonState();
                    });
                });

            }

            changeShowtimeBtn.addEventListener('click', () => {
                currentStep = 1;
                updateUI();
            });

            nextBtn.addEventListener('click', async () => {
                if (currentStep < 3) {
                    currentStep++;
                    updateUI();
                } else {
                    // Bước 3: xác nhận thanh toán
                    const paymentMethod = document.querySelector('input[name="payment"]:checked')
                        .nextSibling.textContent.trim();

                    const payload = {
                        showtime_id: bookingData.showtime_id,
                        seats: bookingData.seats.map(s => parseInt(s)),
                        total: bookingData.total,
                        user_id: {{ auth()->id() }},
                        payment_method: paymentMethod
                    };

                    try {
                        const res = await fetch('/api/tickets', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await res.json();

                        if (data.success) {
                            alert('Đặt vé thành công! Ticket ID: ' + data.ticket_id);
                            window.location.href = "{{ route('home') }}";
                        } else {
                            alert('Đặt vé thất bại: ' + data.message);
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Có lỗi xảy ra khi đặt vé!');
                    }
                }
            });

            backBtn.addEventListener('click', () => {
                if (currentStep > 1) currentStep--;
                updateUI();
            });

            await loadTheaters(); // ✅ bây giờ hợp lệ

            updateUI();
        });
    </script>


</body>

</html>
