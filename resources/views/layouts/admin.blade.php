<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Hiệu ứng hover cho sidebar */
        .sidebar a {
            transition: all 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col sidebar">
            <div class="p-5 text-center text-2xl font-bold border-b border-gray-700">
                ⚡ Admin Panel
            </div>
            <nav class="flex-1 p-4">
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="flex items-center p-3 hover:bg-gray-700 rounded-md transition">
                            👤 <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center p-3 hover:bg-gray-700 rounded-md transition">
                            👤 <span class="ml-3">Quản lý người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="flex items-center p-3 hover:bg-gray-700 rounded-md transition">
                            📂 <span class="ml-3">Quản lý danh mục</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="flex items-center p-3 hover:bg-gray-700 rounded-md transition">
                            🛍️ <span class="ml-3">Quản lý sản phẩm</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Nội dung chính -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-700">📊 Bảng điều khiển</h1>
                <div class="flex items-center">
                    <span class="text-gray-600 mr-4">👋 Xin chào, Admin</span>
                    @if(Auth::check())
                        <div class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Đăng xuất</button>
                            </form>
                        </div>
                    @endif
                </div>
            </header>

            <!-- Nội dung -->
            <main class="flex-1 p-8 bg-white shadow-md rounded-lg mx-6 my-4">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>