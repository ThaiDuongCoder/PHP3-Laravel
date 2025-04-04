@extends('layouts.app')

@section('title', 'Đăng Nhập')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div
            class="bg-white shadow-2xl p-8 rounded-xl max-w-md w-full transform transition-all duration-300 hover:scale-105">
            <h3 class="text-center mb-6 text-2xl font-bold text-gray-800">Đăng Nhập</h3>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm @error('email') border-red-500 @enderror"
                        id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mật khẩu</label>
                    <div class="relative">
                        <input type="password"
                            class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm @error('password') border-red-500 @enderror"
                            id="password" name="password" placeholder="Nhập mật khẩu">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eyeIcon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 bg-indigo-600 text-white rounded-lg font-semibold uppercase tracking-wide hover:bg-indigo-700 transition duration-300 shadow-md">
                    Đăng nhập
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('register') }}"
                    class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition duration-200">
                    Chưa có tài khoản? Đăng ký ngay
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eyeIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.innerHTML = `
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.977 9.977 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                    `;
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.innerHTML = `
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    `;
                }
            });
        </script>
    @endpush
@endsection