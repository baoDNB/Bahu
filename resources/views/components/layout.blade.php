<!DOCTYPE html>
<html lang="vi" data-theme="lofi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ isset($title) ? $title : 'Rút gọn URL' }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen flex flex-col bg-base-200 font-sans">
        <nav class="navbar bg-base-100">
            <div class="navbar-start">
                <a href="/" class="btn btn-ghost text-xl">Bahu</a>
                <a href="{{ route('home') }}" class="btn btn-ghost btn-sm ml-2">Home</a>
                <a href="{{ route('links') }}" class="btn btn-ghost btn-sm ml-2">Links</a>
            </div>
            <div class="navbar-end gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-sm">Đăng ký</a>
                @else
                    <span class="btn btn-ghost btn-sm normal-case">Xin chào, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Đăng xuất</button>
                    </form>
                @endguest
            </div>
        </nav>
        <main class="flex-grow container mx-auto px-4 py-8">
            {{ $slot }}
        </main>
        <footer class="bg-base-100">
            <div class="container mx-auto px-4 py-2 text-center">
                <p class="text-sm">© 2025Bahu. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>

