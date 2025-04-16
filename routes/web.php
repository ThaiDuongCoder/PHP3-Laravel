<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('products');

// Đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

// Đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Phân quyền cho user
Route::middleware(['client', 'verified'])->group(function () {
    Route::get('/detailsproduct/{id}', [ProductController::class, 'show'])->name('detailsproduct');
});

Route::middleware(['admin', 'verified'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('dashboard', 'App\Http\Controllers\Admin\DashboardController');
        Route::resource('users', 'App\Http\Controllers\Admin\UserController');
        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
    });
});

// Route hiển thị trang thông báo xác minh
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Tạo file này trong resources/views/auth
})->middleware('auth')->name('verification.notice');

// Route xử lý xác minh khi người dùng click link trong email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Đánh dấu là đã xác minh
    return redirect('/'); // Redirect sau khi xác minh
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route gửi lại email xác minh
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Đã gửi lại email xác minh!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
