 {{-- Room Management Page --}}
 <!DOCTYPE html>
 <html lang="vi">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Quản lý Phòng chiếu - TVCinema</title>
     <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <style>
         #seatsGrid {
             gap: 8px;
         }

         .seat-row {
             display: flex;
             gap: 4px;
         }

         .seat {
             width: 40px;
             height: 40px;
             border-radius: 6px;
             display: flex;
             align-items: center;
             justify-content: center;
             font-weight: bold;
             cursor: default;
             border: 2px solid #ccc !important;
             /* viền xám */
             background-color: #fff !important;
             /* ghế thường nền trắng */
             color: #333;
             transition: transform 0.2s, box-shadow 0.2s;
         }

         .seat.vip {
             background-color: #fff9c4 !important;
             /* vàng nhạt */
             border: 2px solid #ccc !important;
             /* viền xám */
             color: #555 !important;
         }

         .seat:hover {
             transform: scale(1.1);
             box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
         }


         body {
             background: #f8fafc;
         }

         .sidebar-brand-text {
             font-weight: bold;
             font-size: 22px;
             color: #f6c23e;
         }

         .seat {
             width: 40px;
             height: 40px;
             background-color: #f6c23e;
             color: #1a223f;
             display: flex;
             align-items: center;
             justify-content: center;
             margin: 2px;
             border-radius: 6px;
             font-weight: bold;
             cursor: default;
         }

         .seat.vip {
             background-color: #e74a3b;
             color: #fff;
         }

         .seat-row {
             display: flex;
             gap: 4px;
         }

         .seat.booked {
             background-color: #34495e !important;
             /* màu đậm hơn */
             color: #fff !important;
             /* chữ trắng */
             border: 2px solid #2c3e50 !important;
         }


         .sidebar {
             background: linear-gradient(180deg, #1a223f 10%, #2c3e50 100%);
         }

         .sidebar .nav-link,
         .sidebar .sidebar-heading {
             color: #fff;
         }

         .sidebar .nav-item.active .nav-link {
             background: #f6c23e;
             color: #1a223f;
         }

         .card {
             border-radius: 16px;
         }

         .table-responsive {
             border-radius: 10px;
         }

         .topbar {
             background: #fff;
             box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
         }

         .avatar-img {
             width: 40px;
             height: 40px;
             border-radius: 50%;
             box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
         }

         /* Tăng hiệu ứng fade cho modal */
         .modal.fade .modal-dialog {
             transform: translate(0, -50px);
             transition: transform 0.3s ease-out, opacity 0.3s ease-out;
         }

         .modal.show .modal-dialog {
             transform: translate(0, 0);
         }

         /* Thêm transition cho từng ghế */
         .seat {
             transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.3s ease;
         }

         .seat.booked {
             transition: background-color 0.3s ease, transform 0.2s ease;
         }
     </style>
 </head>

 <body>
     <div id="wrapper">
         <!-- Sidebar -->
         <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
             <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                 <div class="sidebar-brand-icon"><i class="fa-solid fa-film fa-lg" style="color:#f6c23e;"></i></div>
                 <div class="sidebar-brand-text mx-3">TVCinema Admin</div>
             </a>
             <hr class="sidebar-divider my-0">
             <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i
                         class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
             <hr class="sidebar-divider">
             <div class="sidebar-heading">Quản lý</div>
             <li class="nav-item"><a class="nav-link" href="{{ route('movies.index') }}"><i
                         class="fa-solid fa-clapperboard"></i> <span>Phim</span></a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('theaters.index') }}"><i
                         class="fa-solid fa-building"></i> <span>Rạp</span></a></li>
             <li class="nav-item active"><a class="nav-link" href="{{ route('rooms.index') }}"><i
                         class="fa-solid fa-chair"></i> <span>Phòng chiếu</span></a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('showtimes.index') }}"><i
                         class="fa-solid fa-clock"></i> <span>Suất chiếu</span></a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('seats.index') }}"><i
                         class="fa-solid fa-couch"></i> <span>Ghế</span></a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('tickets.index') }}"><i
                         class="fa-solid fa-ticket"></i> <span>Vé</span></a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><i
                         class="fa-solid fa-users"></i> <span>Người dùng</span></a></li>
             <hr class="sidebar-divider d-none d-md-block">
         </ul>
         <!-- End Sidebar -->
         <div id="content-wrapper" class="d-flex flex-column">
             <div id="content">
                 <!-- Topbar -->
                 <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                     <ul class="navbar-nav ml-auto">
                         <li class="nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span
                                     class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name ?? 'Admin' }}</span>
                                 <img class="avatar-img"
                                     src="{{ Auth::user()->avatar ?? asset('assets/img/default-avatar.png') }}"
                                     alt="avatar">
                             </a>
                             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                 <a class="dropdown-item" href="/profile"><i
                                         class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Hồ sơ</a>
                                 <div class="dropdown-divider"></div>
                                 <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"
                                         class="dropdown-item"><i
                                             class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Đăng
                                         xuất</button></form>
                             </div>
                         </li>
                     </ul>
                 </nav>
                 <!-- End Topbar -->
                 <div class="container-fluid">
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h1 class="h3 mb-0 text-gray-800">Quản lý Phòng chiếu</h1>
                         <a href="{{ route('rooms.create') }}" class="btn btn-primary shadow-sm"><i
                                 class="fas fa-plus fa-sm text-white-50"></i> Thêm Phòng Mới</a>
                     </div>

                     <div class="card shadow mb-4">
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                     <thead>
                                         <tr>
                                             <th>Tên phòng</th>
                                             <th>Tên rạp</th>
                                             <th>Hành động</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($rooms as $room)
                                             <tr>
                                                 <td>{{ $room->name }}</td>
                                                 <td>{{ $room->theater->name }}</td>
                                                 <td>
                                                     <a href="{{ route('rooms.edit', $room->room_id) }}"
                                                         class="btn btn-warning btn-sm">Sửa</a>
                                                     <form action="{{ route('rooms.destroy', $room->room_id) }}"
                                                         method="POST" style="display:inline-block;">
                                                         @csrf
                                                         @method('DELETE')
                                                         <button type="submit"
                                                             class="btn btn-danger btn-sm">Xóa</button>
                                                     </form>
                                                     <button type="button" class="btn btn-info btn-sm view-seats-btn"
                                                         data-id="{{ $room->room_id }}">
                                                         Xem chi tiết
                                                     </button>

                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Footer -->
                 <footer class="sticky-footer bg-white">
                     <div class="container my-auto">
                         <div class="copyright text-center my-auto">
                             <span>Copyright &copy; TVCinema {{ date('Y') }}</span>
                         </div>
                     </div>
                 </footer>
             </div>
         </div>
     </div>


     <!-- Seats Modal -->
     <div class="modal fade" id="seatsModal" tabindex="-1" role="dialog" aria-labelledby="seatsModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="seatsModalLabel">Ghế Phòng</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div id="seatsGrid" class="d-flex flex-column gap-2">
                         <!-- Dữ liệu sẽ được điền bằng JS -->
                     </div>
                 </div>
             </div>
         </div>
     </div>



 </body>
 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- Bootstrap 4 JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

 <script>
     $(document).ready(function() {
         $('.view-seats-btn').click(function() {
             var roomId = $(this).data('id');

             $.get('/admin/rooms/' + roomId + '/seats', function(data) {
                 console.log('Dữ liệu ghế:', data); // debug

                 $('#seatsModalLabel').text('Ghế Phòng: ' + data.room_name);
                 var seatsGrid = $('#seatsGrid');
                 seatsGrid.empty();

                 if (!data.seats.length) {
                     seatsGrid.append('<p>Chưa có ghế nào trong phòng.</p>');
                     return;
                 }

                 var rows = {};

                 data.seats.forEach(function(seat) {
                     // Lấy chữ cái đầu nếu có, nếu không gán 'X'
                     var match = seat.seat_number.match(/^[A-Z]/);
                     var rowLetter = match ? match[0] : 'X';
                     if (!rows[rowLetter]) rows[rowLetter] = [];
                     rows[rowLetter].push(seat);
                 });

                 Object.keys(rows).sort().forEach(function(row) {
                     var rowDiv = $('<div class="seat-row mb-2"></div>');

                     rows[row].sort((a, b) => {
                         var aNum = parseInt(a.seat_number.slice(1)) || parseInt(
                             a.seat_number) || 0;
                         var bNum = parseInt(b.seat_number.slice(1)) || parseInt(
                             b.seat_number) || 0;
                         return aNum - bNum;
                     }).forEach(function(seat) {
                         var seatDiv = $('<div class="seat"></div>').text(seat
                             .seat_number);
                         if (seat.seat_type === 'vip') seatDiv.addClass('vip');
                         if (seat.status === 'booked') seatDiv.addClass(
                             'booked'); // ✅ thêm class booked
                         rowDiv.append(seatDiv);
                     });

                     seatsGrid.append(rowDiv);
                 });


                 $('#seatsModal').modal('show');

             }).fail(function() {
                 alert('Lấy dữ liệu ghế thất bại!');
             });
         });
     });
 </script>




 </html>
