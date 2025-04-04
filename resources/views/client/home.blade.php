@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Phần Sản phẩm mới nhất -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Sản phẩm mới nhất</h2>
        @if ($latestProducts->isEmpty())
            <p class="text-gray-600">Không có sản phẩm mới nào để hiển thị.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestProducts as $product)
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
                                    {{ $product->name }}
                                </h5>
                                <p class="text-indigo-600 font-medium mt-2">
                                    {{ number_format($product->price, 0, ',', '.') }} ₫
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
        @endif

        <!-- Phần Tất cả sản phẩm -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 mt-12">Tất cả sản phẩm</h2>
        @if ($allProducts->isEmpty())
            <p class="text-gray-600">Không có sản phẩm nào để hiển thị.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($allProducts as $product)
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
                                    {{ $product->name }}
                                </h5>
                                <p class="text-indigo-600 font-medium mt-2">
                                    {{ number_format($product->price, 0, ',', '.') }} ₫
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

            <!-- Phân trang cho Tất cả sản phẩm -->
            <div class="mt-8 flex justify-center">
                {{ $allProducts->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
@endsection