<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách danh mục để hiển thị trong bộ lọc
        $categories = Category::where('status', 'active')->get();

        // Tạo truy vấn cho sản phẩm
        $query = Product::with('category')
            ->where('status', '!=', 'hidden'); // Ẩn sản phẩm có status = 'hidden'

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo khoảng giá
        if ($request->has('price_min') && !empty($request->price_min)) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && !empty($request->price_max)) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sắp xếp và phân trang (12 sản phẩm mỗi trang)
        $products = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('client.product', compact('products', 'categories'));
    }

    public function show($id)
    {
        // Lấy sản phẩm theo ID, bao gồm thông tin danh mục
        $product = Product::with('category')->findOrFail($id);

        // Kiểm tra nếu sản phẩm có status = 'hidden', trả về lỗi 404
        if ($product->status === 'hidden') {
            abort(404);
        }

        // Lấy 5 sản phẩm liên quan (cùng danh mục, không bao gồm sản phẩm hiện tại, không có status = 'hidden')
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Loại bỏ sản phẩm hiện tại
            ->where('status', '!=', 'hidden') // Ẩn sản phẩm có status = 'hidden'
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('client.detailsproduct', compact('product', 'relatedProducts'));
    }
}
