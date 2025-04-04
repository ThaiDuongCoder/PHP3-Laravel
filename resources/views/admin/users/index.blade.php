@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Tiêu đề + Nút thêm người dùng -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">👤 Quản lý người dùng</h1>
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus"></i> Thêm người dùng mới
            </a>
        </div>

        <!-- Tìm kiếm -->
        <form method="get" class="mb-4">
            <div class="flex">
                <input type="text" name="search" class="border rounded-l-lg px-4 py-2 flex-grow"
                    placeholder="🔍 Tìm kiếm danh mục ..." value="{{ request('search') }}">
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
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 border">ID</th>
                        <th class="px-4 py-3 border">Tên</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">Số điện thoại</th>
                        <th class="px-4 py-3 border">Vai trò</th>
                        <th class="px-4 py-3 border">Trạng thái</th>
                        <th class="px-4 py-3 border">Ngày tạo</th>
                        <th class="px-4 py-3 border">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center">{{ $user->id }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ $user->phone }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($user->role == 'admin')
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-lg text-sm">Admin</span>
                                @else
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-lg text-sm">Client</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($user->status == 'active')
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-lg text-sm">Hoạt động</span>
                                @else
                                    <span class="bg-gray-500 text-white px-2 py-1 rounded-lg text-sm">Vô hiệu hóa</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">
                                        <i class="fas fa-edit">Edit</i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                                            <i class="fas fa-trash">Xoá</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection