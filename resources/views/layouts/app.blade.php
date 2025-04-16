<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


</head>

<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-white shadow-lg py-4 sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/"
                class="text-2xl font-bold text-indigo-600 hover:text-indigo-800 transition duration-300">YourLogo</a>

            <!-- Search Bar -->
            <form method="GET" class="flex w-1/3">
                <input type="text" name="search"
                    class="form-control rounded-l-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm w-full"
                    placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                <button type="submit"
                    class="btn bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 transition duration-300 px-4">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <!-- Navbar -->
            <nav class="hidden md:flex space-x-6">
                <a href="/" class="text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                    <i class="fas fa-home mr-1"></i> Trang chủ
                </a>
                <a href="/product"
                    class="text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                    <i class="fas fa-shopping-bag mr-1"></i> Sản phẩm
                </a>
                <a href="/about" class="text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> Giới thiệu
                </a>
                <a href="/contact"
                    class="text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                    <i class="fas fa-phone-alt mr-1"></i> Liên hệ
                </a>
                <!-- Kiểm tra nếu người dùng là admin -->
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <!-- Kiểm tra nếu người dùng đã đăng nhập và là admin -->
                    <a href="/admin/dashboard"
                        class="text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                        <i class="fas fa-cogs mr-1"></i> Quản trị
                    </a>
                @endif
            </nav>

            <!-- Avatar Dropdown -->
            <div class="relative" id="avatar-container">
                <img src="https://www.svgrepo.com/show/341256/user-avatar-filled.svg" alt="Avatar"
                    class="w-10 h-10 rounded-full cursor-pointer transition-transform duration-300 hover:scale-110">
                <div id="dropdown-menu"
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-xl hidden transition-all duration-200">
                    @if(Auth::check())
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition duration-200">Đăng
                                xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block px-4 py-2 text-indigo-600 hover:bg-indigo-50 transition duration-200">Đăng nhập</a>
                        <a href="{{ route('register') }}"
                            class="block px-4 py-2 text-indigo-600 hover:bg-indigo-50 transition duration-200">Đăng ký</a>
                    @endif
                </div>
            </div>

            <script>
                const avatarContainer = document.getElementById('avatar-container');
                const dropdownMenu = document.getElementById('dropdown-menu');

                // Hiển thị dropdown khi hover vào avatar
                avatarContainer.addEventListener('mouseenter', () => {
                    dropdownMenu.classList.remove('hidden');
                });

                // Ẩn dropdown khi rời chuột khỏi cả avatar-container và dropdown-menu
                avatarContainer.addEventListener('mouseleave', () => {
                    setTimeout(() => {
                        if (!dropdownMenu.matches(':hover')) {
                            dropdownMenu.classList.add('hidden');
                        }
                    }, 100); // Thêm độ trễ nhỏ để chuột có thời gian di vào dropdown
                });

                // Giữ dropdown hiển thị khi hover vào nó
                dropdownMenu.addEventListener('mouseenter', () => {
                    dropdownMenu.classList.remove('hidden');
                });

                // Ẩn dropdown khi rời chuột khỏi dropdown
                dropdownMenu.addEventListener('mouseleave', () => {
                    dropdownMenu.classList.add('hidden');
                });
            </script>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-900 to-indigo-700 text-white py-6 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">© 2025 Your Company. All rights reserved.</p>
            <ul class="flex justify-center space-x-6 mt-2">
                <li><a href="#" class="text-white hover:text-indigo-300 transition duration-300"><i
                            class="fab fa-facebook-f"></i> Facebook</a></li>
                <li><a href="#" class="text-white hover:text-indigo-300 transition duration-300"><i
                            class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#" class="text-white hover:text-indigo-300 transition duration-300"><i
                            class="fab fa-instagram"></i> Instagram</a></li>
            </ul>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>