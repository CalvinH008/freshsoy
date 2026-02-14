@extends('admin.layout')

@section('title', 'Order Detail #' . $order->id)

@section('content')

    <!-- HEADER -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h1>
                <span
                    class="inline-flex px-3 py-1 text-sm font-medium rounded-full
                    {{ $order->status == 'completed'
                        ? 'bg-green-100 text-green-700'
                        : ($order->status == 'pending'
                            ? 'bg-yellow-100 text-yellow-700'
                            : 'bg-red-100 text-red-700') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <p class="text-gray-500 text-sm">Order placed on {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-2 space-y-6">

            <!-- ORDER ITEMS -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Order Items</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex items-center gap-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                                <!-- Product Icon -->
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                                    </p>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-gray-900">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="space-y-6">

            <!-- CUSTOMER INFO -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Customer Info
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($order->user->name ?? 'G', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $order->user->name ?? 'Guest' }}</p>
                            <p class="text-sm text-gray-500">{{ $order->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAYMENT INFO -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Payment Info
                </h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Method</span>
                        <span
                            class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span
                            class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                            {{ $order->status == 'completed'
                                ? 'bg-green-100 text-green-700'
                                : ($order->status == 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- UPDATE STATUS -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Update Status
                </h2>
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        <!-- Status Radio Buttons -->
                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $order->status == 'pending' ? 'bg-yellow-50 border-yellow-300' : '' }}">
                                <input type="radio" name="status" value="pending"
                                    {{ $order->status == 'pending' ? 'checked' : '' }}
                                    class="w-4 h-4 text-amber-500 focus:ring-amber-500">
                                <span class="flex-1 font-medium text-gray-900">Pending</span>
                                <span class="text-yellow-600">⏳</span>
                            </label>

                            <label
                                class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $order->status == 'completed' ? 'bg-green-50 border-green-300' : '' }}">
                                <input type="radio" name="status" value="completed"
                                    {{ $order->status == 'completed' ? 'checked' : '' }}
                                    class="w-4 h-4 text-amber-500 focus:ring-amber-500">
                                <span class="flex-1 font-medium text-gray-900">Completed</span>
                                <span class="text-green-600">✓</span>
                            </label>

                            <label
                                class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition {{ $order->status == 'cancelled' ? 'bg-red-50 border-red-300' : '' }}">
                                <input type="radio" name="status" value="cancelled"
                                    {{ $order->status == 'cancelled' ? 'checked' : '' }}
                                    class="w-4 h-4 text-amber-500 focus:ring-amber-500">
                                <span class="flex-1 font-medium text-gray-900">Cancelled</span>
                                <span class="text-red-600">✗</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-4 py-3 bg-gradient-to-r from-amber-400 to-yellow-500 text-white rounded-lg hover:shadow-lg transition font-semibold flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 z-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

@endsection
