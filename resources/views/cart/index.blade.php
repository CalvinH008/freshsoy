@extends('layouts.main')

@section('title', 'Cart - FreshSoy')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6">

            <!-- BREADCRUMB -->
            <nav class="flex items-center space-x-2 text-sm mb-8 text-gray-500">
                <a href="/" class="hover:text-gray-900">Home</a>
                <span>/</span>
                <span class="text-gray-900">Your Cart</span>
            </nav>

            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900">Cart</h1>
                <p class="text-gray-500 text-sm mt-1">
                    @if (count($cart) > 0)
                        {{ count($cart) }} item(s)
                    @else
                        Your cart is empty
                    @endif
                </p>
            </div>

            @if (count($cart) > 0)
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($cart as $id => $item)
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <div class="flex gap-6">

                                    <!-- Image -->
                                    <div
                                        class="w-20 h-20 bg-gray-50 rounded-lg flex-shrink-0 overflow-hidden border border-gray-100">
                                        @if ($item['image'])
                                            <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-2xl">🥛</div>
                                        @endif
                                    </div>

                                    <!-- Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-gray-900 mb-1 truncate">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500 mb-3">Rp
                                            {{ number_format($item['price'], 0, ',', '.') }} / item</p>

                                        <!-- Quantity Update Form -->
                                        <form action="{{ route('cart.update', $id) }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                min="1" max="100"
                                                class="w-20 text-center border border-gray-300 rounded-lg py-1.5 text-sm font-medium">
                                            <button type="submit"
                                                class="flex items-center space-x-1 bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                    </path>
                                                </svg>
                                                <span>Update</span>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Price & Remove -->
                                    <div class="text-right flex flex-col justify-between items-end">
                                        <p class="text-lg font-bold text-gray-900">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </p>

                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Remove this item from cart?')"
                                                class="flex items-center space-x-1 text-red-600 hover:text-white hover:bg-red-600 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors border border-red-200 hover:border-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                <span>Remove</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white border border-gray-200 rounded-lg p-6 sticky top-24">
                            <h3 class="font-bold text-lg text-gray-900 mb-6">Order Summary</h3>

                            <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium text-gray-900">Rp
                                        {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium text-green-600">Free</span>
                                </div>
                            </div>

                            <div class="flex justify-between mb-6">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-gray-900">Rp
                                    {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <!-- Checkout Button (Merah + Icon) -->
                            <a href="{{ route('checkout.index') }}"
                                class="flex items-center justify-center space-x-2 w-full bg-[#DC2626] text-white py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors mb-3">
                                <span>Proceed to Checkout</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>

                            <!-- Continue Shopping Button -->
                            <a href="/products"
                                class="flex items-center justify-center space-x-2 w-full border-2 border-gray-300 text-gray-700 py-3.5 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Continue Shopping</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white border border-gray-200 rounded-lg p-20 text-center">
                    <div class="text-6xl mb-6 opacity-50">🛒</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h3>
                    <p class="text-gray-500 mb-8">Start adding products!</p>
                    <a href="/products"
                        class="inline-flex items-center space-x-2 bg-[#DC2626] text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Order Now</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection
