@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Shopping Cart</h1>

        @if($cartItems->isNotEmpty())
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Cart Items -->
                <div class="w-full md:w-2/3">
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                    <p class="text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>

                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           class="w-20 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                                        Update
                                    </button>
                                </form>

                                <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="w-full md:w-1/3">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Cart Summary</h2>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout.index') }}" 
                           class="block w-full bg-yellow-400 hover:bg-yellow-300 text-yellow-900 text-center px-6 py-2 rounded-lg">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 mb-4">Your cart is empty.</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-block bg-yellow-400 hover:bg-yellow-300 text-yellow-900 px-6 py-2 rounded-lg">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
@endsection 