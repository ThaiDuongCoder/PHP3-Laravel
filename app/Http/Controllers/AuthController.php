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
        ]);

        if (Auth::attempt($credential)) {
            $user = Auth::user();

            // Kiểm tra trạng thái tài khoản
            if ($user->status === 'inactive') {
                Auth::logout(); // Đăng xuất ngay lập tức nếu tài khoản bị vô hiệu hóa
                return redirect('/login')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa. Vui lòng liên hệ quản trị viên.');
            }

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect('/')->with('success', 'Đăng nhập thành công');
            }
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

        return redirect('/')->with('success', 'Đăng ký thành công!');
    }
}
