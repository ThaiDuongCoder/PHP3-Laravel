@extends('layouts.app')

@section('title', '404 - Không tìm thấy trang')

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center vh-100">
        <h1 class="display-1 text-danger">404</h1>
        <h3 class="text-secondary">Xin lỗi, trang bạn đang tìm kiếm không tồn tại!</h3>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Quay lại trang chủ</a>
    </div>
@endsection