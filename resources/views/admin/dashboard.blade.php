@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')

    <!-- WELCOME MESSAGE -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Welcome back, Admin! 👋</h1>
        <p class="text-gray-500 mt-1">Here's what's happening with your store today.</p>
    </div>

    <!-- STATISTICS CARDS WITH AMBER COLORS & ICONS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <!-- Total Revenue -->
        <div
            class="bg-gradient-to-br from-amber-300 to-amber-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-50 text-sm mb-1">Total Revenue</p>
                    <h2 class="text-3xl font-bold">
                        Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}
                    </h2>
                </div>
                <div class="bg-white/20 p-3 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div
            class="bg-gradient-to-br from-amber-300 to-amber-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-50 text-sm mb-1">Total Orders</p>
                    <h2 class="text-3xl font-bold">
                        {{ $totalOrders ?? 0 }}
                    </h2>
                </div>
                <div class="bg-white/20 p-3 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div
            class="bg-gradient-to-br from-amber-300 to-amber-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-50 text-sm mb-1">Pending Orders</p>
                    <h2 class="text-3xl font-bold">
                        {{ $pendingOrders ?? 0 }}
                    </h2>
                </div>
                <div class="bg-white/20 p-3 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div
            class="bg-gradient-to-br from-amber-300 to-amber-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-50 text-sm mb-1">Total Products</p>
                    <h2 class="text-3xl font-bold">
                        {{ $totalProducts ?? 0 }}
                    </h2>
                </div>
                <div class="bg-white/20 p-3 rounded-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- RECENT ORDERS + TOP PRODUCTS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- RECENT ORDERS -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    Recent Orders
                </h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                    View All
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs text-gray-500 uppercase border-b">
                        <tr>
                            <th class="pb-3 text-left font-medium">Order ID</th>
                            <th class="pb-3 text-left font-medium">Customer</th>
                            <th class="pb-3 text-right font-medium">Total</th>
                            <th class="pb-3 text-center font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentOrders ?? [] as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 text-gray-900 font-medium">#{{ $order->id }}</td>
                                <td class="py-3 text-gray-700">{{ $order->user->name ?? '-' }}</td>
                                <td class="py-3 text-right font-semibold text-gray-900">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </td>
                                <td class="py-3 text-center">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                        {{ $order->status == 'completed'
                                            ? 'bg-green-100 text-green-700'
                                            : ($order->status == 'pending'
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : ($order->status == 'cancelled'
                                                    ? 'bg-red-100 text-red-700'
                                                    : 'bg-blue-100 text-blue-700')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400">
                                    No recent orders
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TOP PRODUCTS -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    Top Products
                </h2>
                <a href="{{ route('admin.products.index') }}"
                    class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                    View All
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs text-gray-500 uppercase border-b">
                        <tr>
                            <th class="pb-3 text-left font-medium">Product</th>
                            <th class="pb-3 text-center font-medium">Stock</th>
                            <th class="pb-3 text-center font-medium">Orders</th>
                            <th class="pb-3 text-right font-medium">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($topProducts ?? [] as $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-lg flex items-center justify-center shadow-sm">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 text-center text-gray-700">
                                    {{ $product->stock ?? 0 }}
                                </td>
                                <td class="py-3 text-center text-gray-700">
                                    {{ $product->orders_count ?? 0 }}
                                </td>
                                <td class="py-3 text-right font-semibold text-gray-900">
                                    Rp
                                    {{ number_format(($product->price ?? 0) * ($product->orders_count ?? 0), 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400">
                                    No product data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
