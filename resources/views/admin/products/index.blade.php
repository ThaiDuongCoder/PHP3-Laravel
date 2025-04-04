@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Tiêu đề + Nút thêm sản phẩm -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">📦 Quản lý sản phẩm</h1>
            <a href="{{ route('admin.products.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                ➕ Thêm sản phẩm mới
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

        <!-- Bảng danh sách sản phẩm -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
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
                    @foreach ($products as $product)
                        <tr class="border">
                            <td class="p-3">{{ $product->id }}</td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">{{ number_format($product->price, 0, ',', '.') }} ₫</td>
                            <td class="p-3">{{ $product->stock }}</td>
                            <td class="p-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded-lg"
                                        alt="{{ $product->name }}">
                                @else
                                    <span class="text-gray-400">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $product->category->name }}</td>
                            <td class="p-3">
                                @if ($product->status == 'available')
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm">Còn hàng</span>
                                @elseif ($product->status == 'out_of_stock')
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm">Hết hàng</span>
                                @else
                                    <span class="bg-gray-500 text-white px-3 py-1 rounded-lg text-sm">Ẩn</span>
                                @endif
                            </td>
                            <td class="p-3">
                                {{ $product->created_at ? $product->created_at->format('d/m/Y') : 'Chưa có ngày' }}
                            </td>
                            <td class="p-3">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                        ✏️ Sửa
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            🗑️ Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="flex justify-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection