@extends('layouts.main')

@section('title', 'Produk - FreshSoy')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-14">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">
                Semua Produk
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                Temukan produk terbaik untuk kebutuhanmu
            </p>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-10">
            <form method="GET" action="/products" class="grid md:grid-cols-12 gap-4 items-end">

                <div class="md:col-span-5">
                    <label class="text-xs text-gray-500 block mb-1">Search</label>
                    <input type="text" name="search" placeholder="Cari produk..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                           focus:outline-none focus:border-gray-400">
                </div>

                <div class="md:col-span-2">
                    <label class="text-xs text-gray-500 block mb-1">Kategori</label>
                    <select name="category"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                           focus:outline-none focus:border-gray-400">
                        <option value="">Semua</option>
                        <option value="minuman">Minuman</option>
                        <option value="makanan">Makanan</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-xs text-gray-500 block mb-1">Urutkan</label>
                    <select name="sort"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                           focus:outline-none focus:border-gray-400">
                        <option value="latest">Terbaru</option>
                        <option value="price_asc">Harga Terendah</option>
                        <option value="price_desc">Harga Tertinggi</option>
                    </select>
                </div>

                <div class="md:col-span-3 flex gap-2">
                    <button type="submit"
                        class="bg-[#DC2626] text-white px-5 py-2.5 rounded-lg text-sm font-medium
                           hover:bg-red-700 transition-all duration-300 flex-1">
                        Filter
                    </button>
                    <a href="/products"
                        class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium
                           hover:bg-gray-200 transition-all duration-300 text-center flex-1">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        <!-- Info -->
        <p class="text-sm text-gray-500 mb-8">
            Menampilkan {{ $products->count() }} produk
        </p>

        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($products as $product)
                <div
                    class="bg-white border border-gray-200/60 rounded-xl overflow-hidden
                    hover:shadow-lg hover:border-gray-300 transition-all duration-300">

                    <!-- Image -->
                    <a href="/products/{{ $product->id }}" class="block overflow-hidden">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}"
                                class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-yellow-50 to-amber-100 flex items-center justify-center text-5xl">
                                🥛
                            </div>
                        @endif
                    </a>

                    <div class="p-5">

                        <!-- Title -->
                        <h3 class="font-semibold text-gray-900 text-base leading-snug mb-2">
                            {{ $product->name }}
                        </h3>

                        <!-- Badge -->
                        <span class="inline-block text-xs bg-green-50 text-green-600 px-2.5 py-1 rounded-md font-medium">
                            {{ ucfirst($product->category ?? 'Produk') }}
                        </span>

                        <!-- Bottom -->
                        <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Harga</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <a href="/products/{{ $product->id }}"
                                class="text-sm font-medium bg-gray-100 text-gray-700
                              px-4 py-2 rounded-lg
                              hover:bg-[#DC2626] hover:text-white transition-all duration-300">
                                Detail
                            </a>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

@endsection