@extends('layouts.app')

@section('title', 'Tất cả sản phẩm')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tất cả sản phẩm</h2>

        <!-- Form lọc -->
        <form method="GET" action="{{ route('products') }}" class="mb-8 bg-white shadow-lg p-6 rounded-xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Lọc theo danh mục -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Danh mục</label>
                    <select name="category_id" id="category_id"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                        <option value="">Tất cả danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lọc theo giá -->
                <div>
                    <label for="price_min" class="block text-sm font-semibold text-gray-700 mb-2">Giá từ</label>
                    <input type="number" name="price_min" id="price_min"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        value="{{ request('price_min') }}" placeholder="Giá tối thiểu">
                </div>
                <div>
                    <label for="price_max" class="block text-sm font-semibold text-gray-700 mb-2">Giá đến</label>
                    <input type="number" name="price_max" id="price_max"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        value="{{ request('price_max') }}" placeholder="Giá tối đa">
                </div>
            </div>
            <div class="mt-6 flex space-x-4">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300">
                    Lọc
                </button>
                <a href="{{ route('products') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                    Xóa bộ lọc
                </a>
            </div>
        </form>

        <!-- Danh sách sản phẩm -->
        @if ($products->isEmpty())
            <p class="text-gray-600">Không có sản phẩm nào để hiển thị.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div
                        class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col">
                        @if ($product->image)
                            <div class="w-full h-64 flex items-center justify-center bg-gray-100">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="max-h-full max-w-full object-contain">
                            </div>

                        @endif
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h5 class="text-lg font-semibold text-gray-800 truncate">
                                    {{ $product->name }}</h5>
                                <p class="text-indigo-600 font-medium mt-2">
                                    {{ number_format($product->price , 0, ',', '.') }} ₫
                                </p>
                            </div>
                            <a href="{{ route('detailsproduct', $product->id) }}"
                                class="mt-3 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 self-start">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Phân trang -->
            <div class="mt-8 flex justify-center">
                {{ $products->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
@endsection