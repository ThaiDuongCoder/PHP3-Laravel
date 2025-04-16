<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Tiêu đề + Nút thêm người dùng -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-4 sm:mb-0">👤 Quản lý người dùng</h1>
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Thêm người dùng mới
            </a>
        </div>

        <!-- Tìm kiếm -->
        <form method="get" class="mb-4">
            <div class="flex">
                <input type="text" name="search"
                    class="border rounded-l-lg px-4 py-2 flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="🔍 Tìm kiếm người dùng ..." value="{{ request('search') }}">
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-r-lg">
                    Tìm kiếm
                </button>
            </div>
        </form>

        <!-- Hiển thị thông báo -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Bảng danh sách người dùng -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm">
                        <th class="px-4 py-3 border">ID</th>
                        <th class="px-4 py-3 border">Tên</th>
                        <th class="px-4 py-3 border">Email</th>
                        {{-- <th class="px-4 py-3 border">Số điện thoại</th> --}}
                        <th class="px-4 py-3 border">Vai trò</th>
                        <th class="px-4 py-3 border">Trạng thái</th>
                        <th class="px-4 py-3 border">Ngày tạo</th>
                        <th class="px-4 py-3 border">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b hover:bg-gray-50 transition text-sm">
                            <td class="px-4 py-3 text-center">{{ $user->id }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            {{-- <td class="px-4 py-3">{{ $user->phone ?? 'N/A' }}</td> --}}
                            <td class="px-4 py-3 text-center">
                                @if($user->role == 'admin')
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-lg text-xs">Admin</span>
                                @else
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-lg text-xs">Client</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($user->status == 'active')
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-lg text-xs">Hoạt động</span>
                                @else
                                    <span class="bg-gray-500 text-white px-2 py-1 rounded-lg text-xs">Vô hiệu hóa</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex space-x-2 justify-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">
                                        <i class="fas fa-edit mr-1"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                                            <i class="fas fa-trash mr-1"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500">Không có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection