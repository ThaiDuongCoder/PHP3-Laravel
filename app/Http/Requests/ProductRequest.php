<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            // 'image' => 'required|image|max:2048|mimes:jpg,png',
            'image' => $this->isMethod('post')
                ? 'required|image|mimes:jpg,jpeg,png|max:4096'
                : 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('status', 'active'),
            ],
            'status' => 'required|in:available,out_of_stock,hidden',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.string' => 'Tên sản phẩm phải là kiểu chuỗi ký tự',
            'name.max' => 'Tên sản phẩm không vượt quá 255 ký tự',

            'description.string' => 'Mô tả phải là kiểu chuỗi ký tự',

            'price.required' => 'Giá sản phẩm không được để trống',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0',

            'stock.required' => 'Số lượng tồn kho không được để trống',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên',
            'stock.min' => 'Số lượng tồn kho không được nhỏ hơn 0',

            'image.required' => 'Hình ảnh sản phẩm là bắt buộc',
            'image.image' => 'File phải là hình ảnh',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
            'image.mimes' => 'Hình ảnh phải có định dạng JPG hoặc PNG',

            'category_id.required' => 'Danh mục sản phẩm không được để trống',
            'category_id.exists' => 'Danh mục đã chọn không hợp lệ hoặc không hoạt động',

            'status.required' => 'Trạng thái không được bỏ trống',
            'status.in' => 'Trạng thái chỉ được chọn là "available", "out_of_stock" hoặc "hidden"',
        ];
    }
}
