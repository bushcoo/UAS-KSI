<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center py-4 px-2">
                        <span class="font-bold text-gray-700 text-lg">{{ config('app.name') }}</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="py-2 px-2 text-gray-700 hover:text-gray-900">Home</a>
                    <a href="{{ route('products.index') }}" class="py-2 px-2 text-gray-700 hover:text-gray-900">Products</a>
                    @auth
                        <a href="{{ route('cart.index') }}" class="py-2 px-2 text-gray-700 hover:text-gray-900 relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                                {{ \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity') }}
                            </span>
                        </a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <a href="{{ route('logout') }}"
                               class="py-2 px-2 text-gray-700 hover:text-gray-900"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="py-2 px-2 text-gray-700 hover:text-gray-900">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-6 px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <div class="text-center text-gray-700">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
