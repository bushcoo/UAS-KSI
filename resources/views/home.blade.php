@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to {{ config('app.name') }}</h1>
        <p class="text-gray-600">Find your favorite products at the best prices.</p>
    </div>

    <!-- Featured Products -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4 truncate">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-yellow-400 hover:bg-yellow-300 text-yellow-900 hover:text-yellow-800 px-4 py-2 rounded">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Categories -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-600">{{ $category->products_count }} Products</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection 