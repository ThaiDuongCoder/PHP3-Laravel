@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Chi tiết sản phẩm -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Chi tiết sản phẩm</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-center">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="max-h-96 w-full object-contain">
                @else
                    <p class="text-gray-600">Không có hình ảnh</p>
                @endif
            </div>
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    {{ $product->name }}
                </h3>
                <p class="text-lg mb-2"><strong class="text-gray-700">Giá:</strong>
                    <span class="text-indigo-600 font-medium">{{ number_format($product->price, 0, ',', '.') }}
                        ₫</span>
                </p>
                <p class="text-lg mb-2"><strong class="text-gray-700">Danh mục:</strong>
                    {{ $product->category->name }}
                </p>
                <p class="text-lg mb-2"><strong class="text-gray-700">Trạng thái:</strong>
                    @if ($product->status == 'available')
                        <span class="text-green-600">Còn hàng</span>
                    @elseif ($product->status == 'out_of_stock')
                        <span class="text-red-600">Hết hàng</span>
                    @else
                        <span class="text-gray-600">Ẩn</span>
                    @endif
                </p>
                <p class="text-lg mb-4"><strong class="text-gray-700">Kho hàng:</strong>
                    {{ $product->stock }}
                </p>
                <div class="flex space-x-4">
                    <a href="{{ route('products') }}"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                        Quay lại
                    </a>
                    @if ($product->status == 'available' && $product->stock > 0)
                        <form action="#" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                                Mua hàng
                            </button>
                        </form>
                    @else
                        <button class="bg-gray-400 text-white px-6 py-2 rounded-lg font-semibold cursor-not-allowed" disabled>
                            Mua hàng
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="mt-8 bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Mô tả sản phẩm</h3>
            <div id="description" class="text-gray-700 text-lg line-clamp-3 overflow-hidden transition-all duration-300">
                {{ $product->description }}
            </div>
            <button id="toggleDescription"
                class="mt-2 text-indigo-600 font-semibold hover:text-indigo-800 transition duration-300">
                Xem thêm
            </button>
        </div>

        <!-- Sản phẩm liên quan -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 mt-12">Sản phẩm liên quan</h2>
        @if ($relatedProducts->isEmpty())
            <p class="text-gray-600">Không có sản phẩm liên quan nào để hiển thị.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div
                        class="bg-white shadow-lg rounded-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col">
                        @if ($relatedProduct->image)
                            <div class="w-full h-64 flex items-center justify-center bg-gray-100">
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                                    class="max-h-full max-w-full object-contain">
                            </div>

                        @endif
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h5 class="text-lg font-semibold text-gray-800 truncate">
                                    {{ $relatedProduct->name }}
                                </h5>
                                <p class="text-indigo-600 font-medium mt-2">
                                    {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                    ₫
                                </p>
                            </div>
                            <a href="{{ route('detailsproduct', $relatedProduct->id) }}"
                                class="mt-3 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 self-start">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- JavaScript để toggle mô tả -->
    <script>
        const description = document.getElementById('description');
        const toggleButton = document.getElementById('toggleDescription');

        toggleButton.addEventListener('click', () => {
            if (description.classList.contains('line-clamp-3')) {
                description.classList.remove('line-clamp-3');
                toggleButton.textContent = 'Thu gọn';
            } else {
                description.classList.add('line-clamp-3');
                toggleButton.textContent = 'Xem thêm';
            }
        });
    </script>
@endsection