@extends('layouts.main')

@section('title', 'Order Success - FreshSoy')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-6">

            <!-- Success Icon & Message -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Placed Successfully!</h1>
                <p class="text-gray-600">Thank you for your order. We'll process it soon.</p>
            </div>

            <!-- Order Info -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-200">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Order Number</p>
                        <p class="font-semibold text-gray-900">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Order Date</p>
                        <p class="font-semibold text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Payment Method</p>
                        <p class="font-semibold text-gray-900">
                            @if ($order->payment_method == 'bank_transfer')
                                Bank Transfer
                            @elseif($order->payment_method == 'e_wallet')
                                E-Wallet
                            @else
                                Cash on Delivery
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Status</p>
                        <span
                            class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <!-- Total -->
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Amount</span>
                    <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Order Items</h3>

                <div class="space-y-3">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-12 h-12 bg-gray-50 rounded border border-gray-100 flex items-center justify-center flex-shrink-0">
                                    @if ($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}"
                                            alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded">
                                    @else
                                        <span class="text-xl">🥛</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }} × Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="font-semibold text-gray-900">Rp
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Payment Instructions -->
            @if ($order->payment_method == 'bank_transfer')
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Payment Instructions
                    </h3>
                    <p class="text-sm text-gray-700 mb-4">Please transfer to one of the following accounts:</p>

                    <div class="space-y-3">
                        <div class="bg-white border border-blue-200 rounded-lg p-4">
                            <p class="font-semibold text-gray-900 mb-1">Bank BCA</p>
                            <p class="text-sm text-gray-700">Account: <span
                                    class="font-mono font-semibold">1234567890</span></p>
                            <p class="text-sm text-gray-700">Name: FreshSoy</p>
                        </div>
                        <div class="bg-white border border-blue-200 rounded-lg p-4">
                            <p class="font-semibold text-gray-900 mb-1">Bank BRI</p>
                            <p class="text-sm text-gray-700">Account: <span
                                    class="font-mono font-semibold">0987654321</span></p>
                            <p class="text-sm text-gray-700">Name: FreshSoy</p>
                        </div>
                    </div>

                    <p class="text-xs text-gray-600 mt-4">⏰ Payment confirmation will be processed within 1×24 hours</p>
                </div>
            @elseif($order->payment_method == 'e_wallet')
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Payment Instructions
                    </h3>
                    <p class="text-sm text-gray-700 mb-4">Transfer to the following e-wallet:</p>

                    <div class="bg-white border border-purple-200 rounded-lg p-4">
                        <p class="font-semibold text-gray-900 mb-1">GoPay / OVO / Dana / ShopeePay</p>
                        <p class="text-sm text-gray-700">Phone: <span class="font-mono font-semibold">0812-3456-7890</span>
                        </p>
                        <p class="text-sm text-gray-700">Name: FreshSoy</p>
                    </div>

                    <p class="text-xs text-gray-600 mt-4">💡 Don't forget to screenshot your payment proof</p>
                </div>
            @else
                <div class="bg-green-50 border border-red-200 rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Delivery Information
                    </h3>
                    <p class="text-sm text-gray-700 mb-2">Your order will be delivered to your registered address.</p>
                    <p class="text-sm text-gray-700 mb-4">Payment will be made when the product is received.</p>
                    <p class="text-sm font-semibold text-gray-900">Please prepare exact cash: Rp
                        {{ number_format($order->total, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-600 mt-4">📦 Estimated delivery: 1-3 business days</p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="/products"
                    class="flex items-center justify-center space-x-2 flex-1 border-2 border-gray-300 text-gray-700 py-3.5 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Continue Shopping</span>
                </a>
                <a href="{{ route('my.orders') }}"
                    class="flex items-center justify-center space-x-2 flex-1 bg-[#DC2626] text-white py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    <span>View My Orders</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </a>
            </div>

        </div>
    </div>

@endsection
