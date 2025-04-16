<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang dashboard với các thống kê về user
     */
    public function index()
    {
        // Tổng số user
        $totalUsers = User::count();

        // Số user mới đăng ký trong ngày
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();

        // Số user mới đăng ký trong tháng
        $monthUsers = User::whereMonth('created_at', Carbon::now()->month)->count();

        // Thống kê user theo trạng thái (ví dụ: active/inactive)
        $activeUsers = User::where('status', true)->count();
        $inactiveUsers = User::where('status', false)->count();

        // Thống kê user đăng ký theo tháng (12 tháng gần nhất)
        $monthlyUserData = $this->getMonthlyUserRegistrations();

        // Thống kê sản phẩm
        $totalProducts = Product::count(); // Tổng số sản phẩm
        $productsToday = Product::whereDate('created_at', Carbon::today())->count(); // Sản phẩm mới hôm nay
        $productsThisMonth = Product::whereMonth('created_at', Carbon::now()->month)->count(); // Sản phẩm mới tháng này

        // Thống kê danh mục
        $totalCategories = Category::count(); // Tổng số danh mục

        return view('admin.dashboard', compact(
            'totalUsers',
            'todayUsers',
            'monthUsers',
            'activeUsers',
            'inactiveUsers',
            'monthlyUserData',
            'totalProducts',
            'productsToday',
            'productsThisMonth',
            'totalCategories'
        ));
    }

    /**
     * Lấy dữ liệu user đăng ký theo tháng (12 tháng gần nhất)
     */
    private function getMonthlyUserRegistrations()
    {
        $data = [];
        $now = Carbon::now();

        for ($i = 11; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $count = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $data[] = [
                'month' => $month->format('M Y'),
                'count' => $count
            ];
        }

        return $data;
    }
}
