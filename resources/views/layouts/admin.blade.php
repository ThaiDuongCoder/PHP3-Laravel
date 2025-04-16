<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang Quản Trị')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease-in-out;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 40;
            display: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">
        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="overlay" :class="{ 'active': sidebarOpen }"></div>

        <!-- Sidebar -->
        <aside :class="{ 'open': sidebarOpen }" class="w-64 bg-gray-900 text-white fixed inset-y-0 z-50 sidebar md:relative md:translate-x-0">
            <div class="p-5 text-center text-2xl font-bold border-b border-gray-700 flex justify-between items-center">
                <span>Admin Panel</span>
                <button @click="sidebarOpen = false" class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-users mr-3"></i>
                            <span>Quản lý người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-folder mr-3"></i>
                            <span>Quản lý danh mục</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                            <i class="fas fa-shopping-bag mr-3"></i>
                            <span>Quản lý sản phẩm</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="md:hidden text-gray-700 mr-4 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-700">@yield('title', 'Bảng điều khiển')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 hidden sm:block">👋 Xin chào, Admin</span>
                    @if(Auth::check())
                        <form action="{{route('logout')}}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                Đăng xuất
                            </button>
                        </form>
                    @endif
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 md:p-8 bg-white shadow-md rounded-lg mx-4 my-4 md:mx-6 md:my-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>