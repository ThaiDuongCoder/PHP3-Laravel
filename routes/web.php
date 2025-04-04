<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('products');

// Đăng nhập Đăng ký
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

// Đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Phân quyền cho user
Route::middleware('client')->group(function () {
    Route::get('/404', function () {
        return view('client.404');
    });

    // Define the route for product details page here
    Route::get('/detailsproduct/{id}', [ProductController::class, 'show'])->name('detailsproduct');
});

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('dashboard', 'App\Http\Controllers\Admin\DashboardController');
        Route::resource('users', 'App\Http\Controllers\Admin\UserController');
        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
    });
});
