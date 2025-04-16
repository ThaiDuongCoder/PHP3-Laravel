@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto p-6 bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">Xác minh email</h2>
        <p class="mb-4">
            Chúng tôi đã gửi một liên kết xác minh đến địa chỉ email của bạn.
            Vui lòng kiểm tra và xác minh trước khi tiếp tục.
        </p>

        @if (session('message'))
            <div class="text-green-600">{{ session('message') }}</div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Gửi lại email xác minh
            </button>
        </form>
    </div>
@endsection