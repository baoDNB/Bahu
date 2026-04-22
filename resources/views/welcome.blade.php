<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rút gọn URL</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[#f3f4f6] text-[#1b1b18] antialiased flex items-center justify-center min-h-screen p-6">
        @if (Route::has('login'))
            <div class="fixed top-0 right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Bảng điều khiển</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Đăng nhập</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Đăng ký</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="w-full max-w-[450px] bg-white border border-gray-200 rounded-3xl shadow-xl p-10">
            <header class="text-center mb-10">
                <div class="inline-block p-3 bg-indigo-100 rounded-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold tracking-tight">Rút gọn URL</h1>
                <p class="text-sm text-gray-500 mt-2">Đơn giản hóa liên kết của bạn trong tích tắc</p>
            </header>

            <form action="{{ route('url.shorten') }}" method="POST" class="space-y-5">
                @csrf
                <div class="relative">
                    <input type="url" name="url" placeholder="Dán link dài vào đây..." required 
                        class="w-full px-5 py-4 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all text-sm shadow-sm">
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-4 rounded-2xl hover:bg-indigo-700 hover:shadow-lg transition-all active:scale-[0.98]">
                    Rút gọn ngay
                </button>
            </form>

            {{-- Hiển thị kết quả khi có link --}}
            @if(session('short_url'))
                <div class="mt-10 p-5 bg-green-50 border border-green-100 rounded-2xl animate-bounce-short">
                    <p class="text-[10px] font-bold text-green-600 uppercase tracking-[0.1em] mb-2">Thành công! Link của bạn:</p>
                    <div class="flex items-center gap-3">
                        <input type="text" readonly value="{{ session('short_url') }}" 
                            class="bg-transparent text-sm font-mono text-green-700 w-full outline-none">
                        <a href="{{ session('short_url') }}" target="_blank" class="text-green-600 hover:text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>

    </body>
</html>