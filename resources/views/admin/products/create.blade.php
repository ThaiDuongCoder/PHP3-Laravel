@extends('layouts.admin')

@section('title', 'Thêm Sản Phẩm Mới')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Tiêu đề + Nút quay lại -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">➕ Thêm Sản Phẩm Mới</h1>
            <a href="{{ route('admin.products.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- Form thêm sản phẩm -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tên sản phẩm -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Tên sản phẩm <span
                        class="text-red-500">*</span></label>
                <input type="text"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror"
                    id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên sản phẩm">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Mô tả</label>
                <textarea
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('description') border-red-500 @enderror"
                    id="description" name="description" rows="4"
                    placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Giá -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium">Giá <span class="text-red-500">*</span></label>
                <input type="number"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('price') border-red-500 @enderror"
                    id="price" name="price" value="{{ old('price') }}" placeholder="Nhập giá sản phẩm">
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
                    id="stock" name="stock" value="{{ old('stock') }}" placeholder="Nhập số lượng sản phẩm">
                @error('stock')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hình ảnh -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium">Hình ảnh <span
                        class="text-red-500">*</span></label>
                <input type="file"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 @error('image') border-red-500 @enderror"
                    id="image" name="image">
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
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Còn hàng</option>
                    <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
                    <option value="hidden" {{ old('status') == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nút submit -->
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition">
                <i class="fas fa-save"></i> Thêm sản phẩm
            </button>
        </form>
    </div>
@endsection