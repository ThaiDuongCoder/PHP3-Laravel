<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('admin.dashboard', compact(
            'totalUsers',
            'todayUsers',
            'monthUsers',
            'activeUsers',
            'inactiveUsers',
            'monthlyUserData'
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

    /**
     * API trả về dữ liệu thống kê user (dùng cho biểu đồ)
     */
    public function getUserStats()
    {
        $monthlyData = $this->getMonthlyUserRegistrations();

        return response()->json([
            'labels' => collect($monthlyData)->pluck('month'),
            'data' => collect($monthlyData)->pluck('count')
        ]);
    }
}
