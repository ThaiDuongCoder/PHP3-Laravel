<!-- resources/views/admin/categories/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Tiêu đề + Nút thêm mới -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-4 sm:mb-0">📂 Quản lý danh mục</h1>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Thêm danh mục mới
            </a>
        </div>

        <!-- Tìm kiếm -->
        <form method="get" class="mb-4">
            <div class="flex">
                <input type="text" name="search"
                    class="border rounded-l-lg px-4 py-2 flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500"
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

        <!-- Bảng danh mục -->
        <div class="overflow-x-auto">
            <table class="min-w-full border bg-white rounded-lg shadow-md">
                <thead class="bg-gray-100 border-b text-gray-700 text-sm">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Tên danh mục</th>
                        <th class="p-3 text-left">Trạng thái</th>
                        <th class="p-3 text-left">Số sản phẩm</th>
                        <th class="p-3 text-left">Ngày tạo</th>
                        <th class="p-3 text-left">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b hover:bg-gray-50 transition text-sm">
                            <td class="p-3">{{ $category->id }}</td>
                            <td class="p-3">{{ $category->name }}</td>
                            <td class="p-3">
                                @if($category->status == 'active')
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-md text-xs">Hiển thị</span>
                                @else
                                    <span class="bg-gray-500 text-white px-2 py-1 rounded-md text-xs">Ẩn</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $category->products->count() }}</td>
                            <td class="p-3">
                                {{ $category->created_at ? $category->created_at->format('d/m/Y') : 'Chưa có ngày' }}
                            </td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md transition">
                                    <i class="fas fa-edit mr-1"></i> Sửa
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này và tất cả sản phẩm thuộc danh mục?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md transition">
                                        <i class="fas fa-trash mr-1"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Không có danh mục nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="mt-4 flex justify-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection