@extends('layouts.main')

@section('title', 'Produk - FreshSoy')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-14">

        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-3xl font-semibold text-gray-900">
                Semua Produk
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Temukan produk terbaik untuk kebutuhanmu
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">

            <!-- SIDEBAR -->
            <aside class="lg:col-span-1">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-10">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Filter Produk
                    </h2>

                    <form method="GET" action="/products" class="space-y-8">

                        <!-- Search -->
                        <div>
                            <label class="text-xs font-medium text-gray-500 mb-2 block">
                                Pencarian
                            </label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari produk..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                            focus:ring-2 focus:ring-red-500 focus:border-red-500
                            transition-all duration-200">
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <!-- Category -->
                        <div>
                            <label class="text-xs font-medium text-gray-500 mb-3 block">
                                Kategori
                            </label>

                            <div class="space-y-2 text-sm">

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="category" value=""
                                        {{ request('category') == null ? 'checked' : '' }}
                                        class="text-red-500 focus:ring-red-500">
                                    Semua
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="category" value="minuman"
                                        {{ request('category') == 'minuman' ? 'checked' : '' }}
                                        class="text-red-500 focus:ring-red-500">
                                    Minuman
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="category" value="makanan"
                                        {{ request('category') == 'makanan' ? 'checked' : '' }}
                                        class="text-red-500 focus:ring-red-500">
                                    Makanan
                                </label>

                            </div>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <!-- Sort -->
                        <div>
                            <label class="text-xs font-medium text-gray-500 mb-2 block">
                                Urutkan
                            </label>

                            <select name="sort"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                            focus:ring-2 focus:ring-red-500 focus:border-red-500
                            transition-all duration-200">

                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                    Terbaru
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    Harga Terendah
                                </option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Harga Tertinggi
                                </option>
                            </select>
                        </div>

                        <div class="pt-4 space-y-3">

                            <button type="submit"
                                class="w-full bg-red-500 text-white py-3 rounded-xl text-sm font-medium
                            hover:bg-red-600 transition-all duration-300 shadow-sm hover:shadow-md">
                                Sort
                            </button>

                            <a href="/products"
                                class="block w-full text-center py-3 rounded-xl text-sm font-medium
                            border border-gray-200 hover:bg-gray-50 transition-all duration-300">
                                Reset
                            </a>

                        </div>

                    </form>

                </div>

            </aside>

            <!-- PRODUCT GRID -->
            <div class="lg:col-span-3">

                <p class="text-sm text-gray-500 mb-10">
                    Menampilkan {{ $products->count() }} produk
                </p>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-10">

                    @forelse ($products as $product)
                        <div
                            class="group bg-white rounded-2xl border border-gray-100
                        hover:shadow-xl hover:-translate-y-1
                        transition-all duration-300 overflow-hidden">

                            <!-- Image -->
                            <a href="/products/{{ $product->id }}" class="block overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}"
                                        class="w-full h-52 object-cover
                                    group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-52 bg-gradient-to-br from-yellow-50 to-amber-100
                                    flex items-center justify-center text-5xl">
                                        🥛
                                    </div>
                                @endif
                            </a>

                            <div class="p-6">

                                <h3 class="font-semibold text-gray-900 mb-2 leading-snug">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-xs text-gray-500 mb-4">
                                    {{ ucfirst($product->category ?? 'Produk') }}
                                </p>

                                <div class="flex items-center justify-between">

                                    <p class="text-lg font-semibold text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <a href="/products/{{ $product->id }}"
                                        class="text-sm font-medium text-red-500
                                    hover:text-red-600 transition">
                                        Detail →
                                    </a>

                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-20">
                            Produk tidak ditemukan.
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

    </div>

@endsection
