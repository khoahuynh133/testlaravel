{{-- Ticket List Page --}}
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Vé - TVCinema</title>
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
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
            <li class="nav-item"><a class="nav-link" href="{{ route('rooms.index') }}"><i class="fa-solid fa-chair"></i>
                    <span>Phòng chiếu</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('showtimes.index') }}"><i
                        class="fa-solid fa-clock"></i> <span>Suất chiếu</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('seats.index') }}"><i class="fa-solid fa-couch"></i>
                    <span>Ghế</span></a></li>
            <li class="nav-item active"><a class="nav-link" href="{{ route('tickets.index') }}"><i
                        class="fa-solid fa-ticket"></i> <span>Vé</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i>
                    <span>Người dùng</span></a></li>
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
                    <h1 class="h3 mb-4 text-gray-800">Danh sách Vé</h1>
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Tạo vé mới</a>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Showtime</th>
                                        <th>Seat</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->ticket_id }}</td>
                                            <td>{{ $ticket->user->name ?? 'N/A' }}</td>
                                            <td>{{ $ticket->showtime->showtime_id ?? 'N/A' }}</td>
                                            <td>{{ $ticket->seat_id }}</td>
                                            <td>{{ number_format($ticket->price, 0, ',', '.') }}</td>
                                            <td>{{ $ticket->status }}</td>
                                            <td>
                                                <a href="{{ route('tickets.edit', $ticket->ticket_id) }}"
                                                    class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{ route('tickets.destroy', $ticket->ticket_id) }}"
                                                    method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                                                </form>
                                                @if ($ticket->status !== 'paid')
                                                    <form action="{{ route('tickets.receive', $ticket->ticket_id) }}"
                                                        method="POST" style="display:inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">Nhận
                                                            vé</button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
