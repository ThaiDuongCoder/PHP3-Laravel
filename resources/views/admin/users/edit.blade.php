@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
        <!-- Tiêu đề + Nút quay lại -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">✏️ Chỉnh sửa người dùng</h1>
            <a href="{{ route('admin.users.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <!-- Form chỉnh sửa người dùng -->
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Họ tên <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name"
                    class="w-full px-3 py-2 border rounded-lg @error('name') border-red-500 @enderror"
                    value="{{ old('name', $user->name) }}">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email"
                    class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror"
                    value="{{ old('email', $user->email) }}">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Mật khẩu
                    <small class="text-gray-500">(Để trống nếu không thay đổi)</small>
                </label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border rounded-lg @error('password') border-red-500 @enderror"
                    value="{{ old('password', $user->password) }}">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium">Số điện thoại <span
                        class="text-red-500">*</span></label>
                <input type="text" id="phone" name="phone"
                    class="w-full px-3 py-2 border rounded-lg @error('phone') border-red-500 @enderror"
                    value="{{ old('phone', $user->phone) }}">
                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium">Vai trò <span
                        class="text-red-500">*</span></label>
                <select id="role" name="role"
                    class="w-full px-3 py-2 border rounded-lg @error('role') border-red-500 @enderror">
                    <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium">Trạng thái <span
                        class="text-red-500">*</span></label>
                <select id="status" name="status"
                    class="w-full px-3 py-2 border rounded-lg @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Vô hiệu hóa
                    </option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition">
                <i class="fas fa-save"></i> Cập nhật
            </button>
        </form>
    </div>
@endsection