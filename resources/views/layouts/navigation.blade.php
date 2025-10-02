

<nav class="bg-gray-900 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="bg-red-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <svg xmlns="{{ asset('/img/TVCinema-logo.webp') }}" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <!-- (giữ nguyên SVG) -->
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-red-500 to-yellow-400 bg-clip-text text-transparent">
                        CINEMA+
                    </span>
                </a>
            </div>

            <!-- Menu chính: cho phép cuộn ngang trên mobile nếu cần -->
            <div class="flex-1 mx-4 overflow-x-auto whitespace-nowrap hide-scrollbar">
                <div class="flex items-center space-x-5">
                    <a href="{{ route('movies.now-showing') }}" class="font-medium py-2 px-1 transition-colors duration-200 {{ request()->routeIs('movies.now-showing') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-300 hover:text-red-500' }}">
                        Phim đang chiếu
                    </a>
                    <a href="{{ route('movies.coming-soon') }}" class="font-medium py-2 px-1 transition-colors duration-200 {{ request()->routeIs('movies.coming-soon') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-300 hover:text-red-500' }}">
                        Sắp chiếu
                    </a>
                    <a href="{{ route('promotions') }}" class="font-medium py-2 px-1 transition-colors duration-200 {{ request()->routeIs('promotions') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-300 hover:text-red-500' }}">
                        Khuyến mãi
                    </a>
                    <a href="{{ route('cinemas') }}" class="font-medium py-2 px-1 transition-colors duration-200 {{ request()->routeIs('cinemas') ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-300 hover:text-red-500' }}">
                        Rạp
                    </a>
                </div>
            </div>

            <!-- Khu vực người dùng -->
            <div class="flex-shrink-0 flex items-center space-x-3">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-sm font-medium text-gray-300 hover:text-white">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-600 to-yellow-500 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            </button>
                        </x-slot>
                        <x-slot name="content" class="bg-gray-800 border border-gray-700">
                            <x-dropdown-link href="{{ route('profile.edit') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white">
                                Tài khoản
                            </x-dropdown-link>
                            <x-dropdown-link href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white">
                                Vé của tôi
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:bg-red-700 hover:text-white">
                                    Đăng xuất
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-1.5 text-sm rounded font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 text-sm bg-red-600 hover:bg-red-700 text-white font-medium rounded transition">
                        Đăng ký
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Thêm CSS ẩn thanh cuộn (nếu dùng Tailwind, bạn có thể thêm vào file CSS) -->
<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;     /* Firefox */
}
</style>