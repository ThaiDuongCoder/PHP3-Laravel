<!-- resources/views/admin/products/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Tiêu đề + Nút thêm sản phẩm -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-4 sm:mb-0">📦 Quản lý sản phẩm</h1>
            <a href="{{ route('admin.products.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Thêm sản phẩm mới
            </a>
        </div>

        <!-- Tìm kiếm -->
        <form method="get" class="mb-4">
            <div class="flex">
                <input type="text" name="search"
                    class="border rounded-l-lg px-4 py-2 flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="🔍 Tìm kiếm sản phẩm ..." value="{{ request('search') }}">
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

        <!-- Bảng danh sách sản phẩm -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="border p-3">ID</th>
                        <th class="border p-3">Tên sản phẩm</th>
                        <th class="border p-3">Giá</th>
                        <th class="border p-3">Kho hàng</th>
                        <th class="border p-3">Hình ảnh</th>
                        <th class="border p-3">Danh mục</th>
                        <th class="border p-3">Trạng thái</th>
                        <th class="border p-3">Ngày tạo</th>
                        <th class="border p-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border hover:bg-gray-50 transition text-sm">
                            <td class="p-3 text-center">{{ $product->id }}</td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                            <td class="p-3 text-center">{{ $product->stock }}</td>
                            <td class="p-3 text-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-12 h-12 object-cover rounded-lg mx-auto" alt="{{ $product->name }}">
                                @else
                                    <span class="text-gray-400">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                {{ $product->category?->name ?? 'Không có danh mục' }}
                            </td>
                            <td class="p-3 text-center">
                                @if ($product->status == 'available')
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs">Còn hàng</span>
                                @elseif ($product->status == 'out_of_stock')
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs">Hết hàng</span>
                                @else
                                    <span class="bg-gray-500 text-white px-3 py-1 rounded-lg text-xs">Ẩn</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                {{ $product->created_at ? $product->created_at->format('d/m/Y') : 'Chưa có ngày' }}
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex space-x-2 justify-center">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                        <i class="fas fa-edit mr-1"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            <i class="fas fa-trash mr-1"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-3 text-center text-gray-500">Không có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="flex justify-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection