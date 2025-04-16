<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ]);

        if (Auth::attempt($credential, $request->filled('remember'))) {
            $user = Auth::user();

            // Kiểm tra trạng thái tài khoản
            if ($user->status === 'inactive') {
                Auth::logout(); // Đăng xuất ngay lập tức nếu tài khoản bị vô hiệu hóa
                return redirect('/login')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa. Vui lòng liên hệ quản trị viên.');
            }

            if ($user->role === 'admin' || $user->role === 'client') {
                return redirect('/')->with('success', 'Đăng nhập thành công');
            }

            return redirect('/')->with('error', 'Không có quyền truy cập');
        }

        // Nếu đăng nhập thất bại (email/mật khẩu sai)
        return redirect('/login')->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    public function register(Request $request)
    {
        $credential = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15'
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
        ]);

        $user = User::create([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => Hash::make($credential['password']),
            'phone' => $credential['phone'],
            'role' => 'client',
            'status' => 'active',
        ]);

        Auth::login($user);

        // Gửi email xác thực
        $user->sendEmailVerificationNotification();

        // return redirect('/')->with('success', 'Đăng ký thành công!');
        return redirect()->route('verification.notice');
    }
}
