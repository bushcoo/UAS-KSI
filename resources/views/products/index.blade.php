@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Sidebar -->
        <div class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Categories</h2>
                <div class="space-y-2">
                    <a href="{{ route('products.index') }}" class="block text-gray-600 hover:text-gray-900">All Products</a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                           class="block text-gray-600 hover:text-gray-900 {{ request('category') == $category->slug ? 'font-semibold' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="w-full md:w-3/4">
            <!-- Search -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <form action="{{ route('products.index') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search products..." 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-yellow-900 px-6 py-2 rounded-lg">
                        Search
                    </button>
                </form>
            </div>

            <!-- Products -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4 truncate">{{ $product->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="bg-yellow-400 hover:bg-yellow-300 text-yellow-900 hover:text-yellow-800 px-4 py-2 rounded">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600">No products found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection 