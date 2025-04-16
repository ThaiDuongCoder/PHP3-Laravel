@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Sản phẩm mới nhất</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($latestProducts as $product)
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl shadow-md p-4 w-full">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-64 object-contain mb-4 rounded">
                            <h3 class="font-semibold text-lg truncate">{{ $product->name }}</h3>
                            <p class="text-purple-600 font-bold mt-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            <a href="{{ route('detailsproduct', $product->id) }}"
                                class="inline-block mt-3 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nút điều hướng -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <script>
            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 2
                    },
                    480: {
                        slidesPerView: 1
                    }
                }
            });
        </script>


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