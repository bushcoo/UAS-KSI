@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Product Image -->
            <div class="w-full md:w-1/2">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
            </div>

            <!-- Product Info -->
            <div class="w-full md:w-1/2">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-2xl font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="text-gray-600">Stock: {{ $product->stock }}</span>
                </div>

                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.store') }}" method="POST" class="flex gap-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                   class="w-20 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-yellow-900 px-6 py-2 rounded-lg">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <p class="text-red-600">Out of stock</p>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-yellow-900 px-6 py-2 rounded-lg">
                        Login to Buy
                    </a>
                @endauth

                <!-- Category Info -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Category</h2>
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" 
                       class="text-gray-600 hover:text-gray-900">
                        {{ $product->category->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $relatedProduct->name }}</h3>
                            <p class="text-gray-600 mb-4 truncate">{{ $relatedProduct->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-gray-800">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                                   class="bg-yellow-400 hover:bg-yellow-300 text-yellow-900 hover:text-yellow-800 px-4 py-2 rounded">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection 