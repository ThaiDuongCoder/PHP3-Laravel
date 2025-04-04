@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
        <!-- Tiêu đề + Nút quay lại -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">✏️ Chỉnh sửa danh mục</h1>
            <a href="{{ route('admin.categories.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                🔙 Quay lại
            </a>
        </div>

        <!-- Form chỉnh sửa danh mục -->
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Tên danh mục -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Tên danh mục <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200
                            @error('name') border-red-500 @enderror" value="{{ old('name', $category->name) }}"
                    placeholder="Nhập tên danh mục">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mô tả -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Mô tả</label>
                <textarea id="description" name="description" rows="3" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200
                            @error('description') border-red-500 @enderror"
                    placeholder="Nhập mô tả">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium">Trạng thái <span
                        class="text-red-500">*</span></label>
                <select id="status" name="status" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200
                                                           @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Hiển thị
                    </option>
                    <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Ẩn
                    </option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nút bấm -->
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                💾 Cập nhật danh mục
            </button>
        </form>
    </div>
@endsection