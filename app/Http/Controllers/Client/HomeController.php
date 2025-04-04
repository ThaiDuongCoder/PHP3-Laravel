<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Lấy 5 sản phẩm mới nhất
        $latestProducts = Product::with('category')
            ->where('status', '!=', 'hidden')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Lấy tất cả sản phẩm với phân trang
        $query = Product::with('category')
            ->where('status', '!=', 'hidden');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $allProducts = $query->orderBy('created_at', 'desc')->paginate(6);

        // Trả về view với cả hai danh sách sản phẩm
        return view('client.home', compact('latestProducts', 'allProducts'));
    }
}
