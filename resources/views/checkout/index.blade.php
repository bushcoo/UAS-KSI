@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Checkout Form -->
            <div class="w-full md:w-2/3">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <!-- Shipping Address -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Shipping Address</h2>
                            <textarea name="shipping_address" rows="3" required
                                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                      placeholder="Enter your shipping address">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Billing Address -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Billing Address</h2>
                            <textarea name="billing_address" rows="3" required
                                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                      placeholder="Enter your billing address">{{ old('billing_address') }}</textarea>
                            @error('billing_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Method</h2>
                            <select name="payment_method" required
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                <option value="">Select payment method</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                            @error('payment_method')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-300 text-yellow-900 px-6 py-3 rounded-lg">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="w-full md:w-1/3">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Summary</h2>
                    
                    <!-- Items -->
                    <div class="space-y-4 mb-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-semibold">{{ $item->product->name }}</p>
                                    <p class="text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <span class="font-semibold">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between text-xl font-bold">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 