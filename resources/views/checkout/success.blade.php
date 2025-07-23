@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
        <div class="mb-6">
            <i class="fas fa-check-circle text-6xl text-green-500"></i>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Thank You for Your Order!</h1>
        <p class="text-gray-600 mb-6">Your order has been placed successfully.</p>
        
        <div class="bg-gray-50 rounded-lg p-6 max-w-md mx-auto mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Order Details</h2>
            <div class="space-y-2 text-left">
                <div class="flex justify-between">
                    <span class="text-gray-600">Order Number:</span>
                    <span class="font-semibold">{{ $order->order_number }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Status:</span>
                    <span class="font-semibold">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                </div>
            </div>
        </div>

        <div class="space-x-4">
            <a href="{{ route('home') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg">
                Back to Home
            </a>
            <a href="{{ route('products.index') }}" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-yellow-900 px-6 py-2 rounded-lg">
                Continue Shopping
            </a>
        </div>
    </div>
@endsection 