@extends('layouts.main')

@section('title', 'Checkout - FreshSoy')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-6">

            <!-- BREADCRUMB -->
            <nav class="flex items-center space-x-2 text-sm mb-8 text-gray-500">
                <a href="/" class="hover:text-gray-900">Home</a>
                <span>/</span>
                <a href="/cart" class="hover:text-gray-900">Cart</a>
                <span>/</span>
                <span class="text-gray-900">Checkout</span>
            </nav>

            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
                <p class="text-gray-500 text-sm mt-1">Complete your order</p>
            </div>

            <!-- Order Summary -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Order Summary</h3>

                <div class="space-y-3 mb-6">
                    @foreach ($cart as $item)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 bg-gray-50 rounded border border-gray-100 flex items-center justify-center flex-shrink-0">
                                    @if ($item['image'])
                                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}"
                                            class="w-full h-full object-cover rounded">
                                    @else
                                        <span class="text-xl">🥛</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm">{{ $item['name'] }}</h4>
                                    <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <p class="font-semibold text-gray-900">Rp
                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between mb-2 text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-4 text-sm">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Method (SIMPLE & CLEAN) -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                <h3 class="font-bold text-lg text-gray-900 mb-6">Payment Method</h3>

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="space-y-3 mb-6">

                        <!-- Bank Transfer -->
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="payment_method" value="bank_transfer" required
                                class="w-4 h-4 text-gray-900 border-gray-300 focus:ring-2 focus:ring-gray-900">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-semibold text-gray-900 block">Bank Transfer</span>
                                        <p class="text-sm text-gray-500 mt-0.5">BCA, BRI, Mandiri</p>
                                    </div>
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="payment_method" value="e_wallet" required
                                class="w-4 h-4 text-gray-900 border-gray-300 focus:ring-2 focus:ring-gray-900">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-semibold text-gray-900 block">E-Wallet</span>
                                        <p class="text-sm text-gray-500 mt-0.5">GoPay, OVO, Dana, ShopeePay</p>
                                    </div>
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <!-- COD -->
                        <label
                            class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="payment_method" value="cod" required
                                class="w-4 h-4 text-gray-900 border-gray-300 focus:ring-2 focus:ring-gray-900">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-semibold text-gray-900 block">Cash on Delivery</span>
                                        <p class="text-sm text-gray-500 mt-0.5">Pay when received</p>
                                    </div>
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <a href="/cart"
                            class="flex items-center justify-center space-x-2 flex-1 border-2 border-gray-300 text-gray-700 py-3.5 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Back to Cart</span>
                        </a>
                        <button type="submit"
                            class="flex items-center justify-center space-x-2 flex-1 bg-[#DC2626] text-white py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                            <span>Place Order</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
