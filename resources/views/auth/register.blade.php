<x-layout title="Đăng ký">
    <div class="flex justify-center">
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-3xl shadow-xl p-10">
            <h1 class="text-3xl font-bold text-center mb-6">Đăng ký</h1>

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-2">Tên</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none">
                    @error('name')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none">
                    @error('email')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Mật khẩu</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none">
                    @error('password')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none">
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-4 rounded-2xl hover:bg-indigo-700 transition-all">
                    Đăng ký
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-4">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Đăng nhập</a>
            </p>
        </div>
    </div>
</x-layout>