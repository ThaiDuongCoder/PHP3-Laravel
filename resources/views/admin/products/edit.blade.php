<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
        <!-- Tiêu đề + Nút quay lại -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700 mb-4 sm:mb-0">✏️ Chỉnh Sửa Sản Phẩm</h1>
            <a href="{{ route('admin.products.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <!-- Form chỉnh sửa sản phẩm -->
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tên sản phẩm -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Tên sản phẩm <span
                        class="text-red-500">*</span></label>
                <input type="text"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror"
                    id="name" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Mô tả</label>
                <textarea
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('description') border-red-500 @enderror"
                    id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Giá -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium">Giá <span class="text-red-500">*</span></label>
                <input type="number"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('price') border-red-500 @enderror"
                    id="price" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kho hàng -->
            <div class="mb-4">
                <label for="stock" class="block text-gray-700 font-medium">Kho hàng <span
                        class="text-red-500">*</span></label>
                <input type="number"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('stock') border-red-500 @enderror"
                    id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                @error('stock')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hình ảnh -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium">Hình ảnh <small class="text-gray-500">(Để trống
                        nếu không thay đổi)</small></label>
                <input type="file"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('image') border-red-500 @enderror"
                    id="image" name="image">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2 rounded-lg"
                        alt="{{ $product->name }}">
                @endif
                @error('image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Danh mục -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium">Danh mục <span
                        class="text-red-500">*</span></label>
                <select
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('category_id') border-red-500 @enderror"
                    id="category_id" name="category_id">
                    <option value="" disabled {{ old('category_id', $product->category_id) ? '' : 'selected' }}>Chọn danh
                        mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium">Trạng thái <span
                        class="text-red-500">*</span></label>
                <select
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('status') border-red-500 @enderror"
                    id="status" name="status">
                    <option value="available" {{ old('status', $product->status) == 'available' ? 'selected' : '' }}>Còn hàng
                    </option>
                    <option value="out_of_stock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>Hết
                        hàng</option>
                    <option value="hidden" {{ old('status', $product->status) == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nút submit -->
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition">
                <i class="fas fa-save mr-2"></i> Cập nhật sản phẩm
            </button>
        </form>
    </div>
@endsection