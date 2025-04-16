<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->orderBy('id', 'desc')->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->where('status', 'active')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // Kiểm tra nếu stock = 0 và status = available thì chuyển status thành out_of_stock
        if ($data['stock'] == 0 && $data['status'] == 'available') {
            $data['status'] = 'out_of_stock';
        }
        if ($data['stock'] > 0 && $data['status'] == 'out_of_stock') {
            $data['status'] = 'available';
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->where('status', 'active')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Kiểm tra nếu stock = 0 và status = available thì chuyển status thành out_of_stock
        if ($data['stock'] == 0 && $data['status'] == 'available') {
            $data['status'] = 'out_of_stock';
        }
        if ($data['stock'] > 0 && $data['status'] == 'out_of_stock') {
            $data['status'] = 'available';
        }

        // Nếu có ảnh mới, lưu ảnh và xóa ảnh cũ
        if ($request->hasFile('image')) {
            // Lưu ảnh mới
            $data['image'] = $request->file('image')->store('products', 'public');

            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        } else {
            // Nếu không có ảnh mới, giữ ảnh cũ
            $data['image'] = $product->image;
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Nếu sản phẩm có ảnh, thì xóa ảnh khỏi storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa thành công');
    }
}
