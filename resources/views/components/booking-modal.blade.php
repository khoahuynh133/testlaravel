<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Chọn suất chiếu và ghế</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- BƯỚC 1: Chọn ngày -->
                <div id="step1">
                    <h5>Chọn ngày có suất chiếu:</h5>
                    <div id="date-list" class="mt-2"></div>
                    <button class="btn btn-primary mt-3" id="next-to-theater-system" disabled>Chọn hệ thống rạp</button>
                </div>


                <!-- BƯỚC 2: Chọn hệ thống rạp -->
                <div id="step2" style="display:none;">
                    <h5>Chọn hệ thống rạp:</h5>
                    <div id="theater-system-list" class="mt-2"></div>
                    <button class="btn btn-secondary" id="back-to-date">Quay lại</button>
                    <button class="btn btn-primary" id="next-to-theater" disabled>Chọn rạp</button>
                </div>

                <!-- BƯỚC 3: Chọn rạp -->
                <div id="step3" style="display:none;">
                    <h5>Chọn rạp:</h5>
                    <div id="theater-list" class="mt-2"></div>
                    <button class="btn btn-secondary" id="back-to-theater-system">Quay lại</button>
                    <button class="btn btn-primary" id="next-to-room" disabled>Chọn phòng</button>
                </div>

                <!-- BƯỚC 4: Chọn phòng -->
                <div id="step4" style="display:none;">
                    <h5>Chọn phòng:</h5>
                    <div id="room-list" class="mt-2"></div>
                    <button class="btn btn-secondary" id="back-to-theater">Quay lại</button>
                    <button class="btn btn-primary" id="next-to-showtime" disabled>Chọn suất chiếu</button>
                </div>

                <!-- BƯỚC 5: Chọn suất chiếu -->
                <div id="step5" style="display:none;">
                    <h5>Chọn suất chiếu:</h5>
                    <div id="showtime-list" class="mt-2"></div>
                    <button class="btn btn-secondary" id="back-to-room">Quay lại</button>
                    <button class="btn btn-primary" id="next-to-seat" disabled>Chọn ghế</button>
                </div>

                <!-- BƯỚC 6: Chọn ghế -->
                <div id="step6" style="display:none;">
                    <h5>Chọn ghế:</h5>
                    <div class="seat-map"></div>
                    <p><strong>Tổng tiền:</strong> <span id="total-price">0đ</span></p>
                    <p><strong>Ghế đã chọn:</strong> <span id="selected-seats"></span></p>
                    <button class="btn btn-secondary" id="back-to-showtime">Quay lại</button>
                    <button class="btn btn-primary" id="next-to-info">Tiếp tục</button>
                </div>
                
                <!-- BƯỚC 7: Nhập thông tin -->
                <div id="step7" style="display:none;">
                    <h5>Thông tin người mua</h5>
                    <form id="booking-form">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                            <select class="form-select" id="payment_method" required>
                                <option value="momo">Ví điện tử (Momo)</option>
                                <option value="card">Thẻ ngân hàng</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" id="back-to-seat">Quay lại</button>
                        <button type="submit" class="btn btn-success">Xác nhận đặt vé</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
