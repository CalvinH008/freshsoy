@extends('layouts.main')

@section('title', 'My Orders - FreshSoy')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6">

            <!-- BREADCRUMB -->
            <nav class="flex items-center space-x-2 text-sm mb-8 text-gray-500">
                <a href="/" class="hover:text-gray-900">Home</a>
                <span>/</span>
                <span class="text-gray-900">My Orders</span>
            </nav>

            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
                <p class="text-gray-500 text-sm mt-1">Track and manage your orders</p>
            </div>

            @if ($orders->count() > 0)
                <div class="space-y-4">
                    @foreach ($orders as $order)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">

                            <!-- Order Header -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Order Number</p>
                                        <p class="font-semibold text-gray-900">
                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div class="h-8 w-px bg-gray-200"></div>
                                    <div>
                                        <p class="text-sm text-gray-500">Date</p>
                                        <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="h-8 w-px bg-gray-200"></div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total</p>
                                        <p class="font-bold text-gray-900">Rp
                                            {{ number_format($order->total, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div>
                                    @if ($order->status == 'pending')
                                        <span
                                            class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            Pending
                                        </span>
                                    @elseif($order->status == 'processing')
                                        <span
                                            class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            Processing
                                        </span>
                                    @elseif($order->status == 'completed')
                                        <span
                                            class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            Completed
                                        </span>
                                    @else
                                        <span
                                            class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1.5 rounded-full">
                                            Cancelled
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Order Items Preview -->
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-3">Items ({{ $order->items->count() }})</p>
                                <div class="flex items-center space-x-3 overflow-x-auto pb-2">
                                    @foreach ($order->items->take(4) as $item)
                                        <div
                                            class="flex-shrink-0 w-16 h-16 bg-gray-50 rounded border border-gray-100 flex items-center justify-center">
                                            @if ($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-cover rounded">
                                            @else
                                                <span class="text-2xl">🥛</span>
                                            @endif
                                        </div>
                                    @endforeach

                                    @if ($order->items->count() > 4)
                                        <div
                                            class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded border border-gray-200 flex items-center justify-center">
                                            <span
                                                class="text-xs font-medium text-gray-600">+{{ $order->items->count() - 4 }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Payment Method & Actions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span>
                                        @if ($order->payment_method == 'bank_transfer')
                                            Bank Transfer
                                        @elseif($order->payment_method == 'e_wallet')
                                            E-Wallet
                                        @else
                                            Cash on Delivery
                                        @endif
                                    </span>
                                </div>

                                <a href="{{ route('checkout.success', $order->id) }}"
                                    class="flex items-center space-x-2 bg-[#DC2626] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                                    <span>View Details</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white border border-gray-200 rounded-lg p-20 text-center">
                    <div class="text-6xl mb-6 opacity-50">📦</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No orders yet</h3>
                    <p class="text-gray-500 mb-8">Start shopping and your orders will appear here</p>
                    <a href="/products"
                        class="inline-flex items-center space-x-2 bg-[#DC2626] text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Start Shopping</span>
                    </a>
                </div>
            @endif

        </div>
    </div>

@endsection
