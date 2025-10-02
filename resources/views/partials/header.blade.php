<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/TVCinema-logo.webp') }}" alt="Logo" width="40"
                 class="me-2 animate__animated animate__pulse animate__infinite">
            <span class="fw-bold text-uppercase">TVCinema</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Trang chủ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Phim</a>
                    <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__fadeIn">
                        <li><a class="dropdown-item" href="{{ url('/phim-dang-chieu') }}">Phim đang chiếu</a></li>
                        <li><a class="dropdown-item" href="{{ url('/phim-sap-chieu') }}">Phim sắp chiếu</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Rạp chiếu</a>
                    <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__fadeIn">
                        <li><a class="dropdown-item" href="#">CGV</a></li>
                        <li><a class="dropdown-item" href="#">Galaxy Cinema</a></li>
                        <li><a class="dropdown-item" href="#">Lotte Cinema</a></li>
                        <li><a class="dropdown-item" href="#">BHD Star</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/lien-he') }}">Liên hệ</a></li>
            </ul>
            <a href="#" class="btn btn-primary ms-lg-3">🎟 Mua Vé</a>
        </div>
    </div>
</nav>
