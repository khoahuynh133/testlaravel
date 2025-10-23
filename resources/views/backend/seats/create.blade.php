 {{-- Create Seat Page --}}
 <!DOCTYPE html>
 <html lang="vi">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Thêm Ghế Mới - TVCinema</title>
     <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <style>
         body {
             background: #f8fafc;
         }

         .sidebar-brand-text {
             font-weight: bold;
             font-size: 22px;
             color: #f6c23e;
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
             <li class="nav-item"><a class="nav-link" href="{{ route('rooms.index') }}"><i
                         class="fa-solid fa-chair"></i> <span>Phòng chiếu</span></a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('showtimes.index') }}"><i
                         class="fa-solid fa-clock"></i> <span>Suất chiếu</span></a></li>
             <li class="nav-item active"><a class="nav-link" href="{{ route('seats.index') }}"><i
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
                     <h1 class="h3 mb-4 text-gray-800">Thêm Ghế Mới</h1>
                     <div class="card shadow mb-4">
                         <div class="card-body">
                             <form action="{{ route('seats.store_multiple') }}" method="POST">
                                 @csrf
                                 <div class="form-group">
                                     <label for="room_id">Phòng chiếu</label>
                                     <select class="form-control" id="room_id" name="room_id" required>
                                         @foreach ($rooms as $room)
                                             <option value="{{ $room->room_id }}">{{ $room->name }} -
                                                 {{ $room->theater->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <div class="form-group">
                                     <label for="rows">Số hàng (vd: 5 -> A, B, C, D, E)</label>
                                     <input type="number" class="form-control" id="rows" name="rows"
                                         min="1" required>
                                 </div>

                                 <div class="form-group">
                                     <label for="columns">Số ghế mỗi hàng</label>
                                     <input type="number" class="form-control" id="columns" name="columns"
                                         min="1" required>
                                 </div>

                                 <div class="form-group">
                                     <label for="seat_type">Loại ghế</label>
                                     <select class="form-control" id="seat_type" name="seat_type" required>
                                         <option value="standard">Standard</option>
                                         <option value="vip">VIP</option>
                                     </select>
                                 </div>

                                 <button type="submit" class="btn btn-primary">Thêm Ghế</button>
                                 <a href="{{ route('seats.index') }}" class="btn btn-secondary">Hủy</a>
                             </form>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>
