@extends('layouts.main')

@section('title', 'Produk - FreshSoy')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-12">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Semua Produk</h1>
        <p class="text-gray-600">Total {{ $products->count() }} produk tersedia</p>
    </div>
    
    <!-- Filter, Search, Sort -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8" x-data="{ showFilters: true }">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-lg">Filter & Pencarian</h3>
            <button @click="showFilters = !showFilters" class="text-soya-red md:hidden">
                <span x-text="showFilters ? 'Sembunyikan' : 'Tampilkan'"></span>
            </button>
        </div>
        
        <form method="GET" action="/products" class="space-y-4" x-show="showFilters" x-transition>
            <div class="grid md:grid-cols-4 gap-4">
                
                <!-- Search -->
                <input type="text" 
                       name="search" 
                       placeholder="Cari produk..." 
                       value="{{ request('search') }}"
                       class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-soya-red focus:border-transparent">
                
                <!-- Category Filter -->
                <select name="category" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-soya-red">
                    <option value="">Semua Kategori</option>
                    <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                </select>
                
                <!-- Sort -->
                <select name="sort" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-soya-red">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                </select>
                
                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-soya-red text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                        Filter
                    </button>
                    <a href="/products" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors text-center">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Products Grid -->
    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            
            <!-- Image -->
            <a href="/products/{{ $product->id }}" class="block h-48 bg-gray-100 overflow-hidden">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl">🥛</div>
                @endif
            </a>
            
            <!-- Info -->
            <div class="p-4">
                <a href="/products/{{ $product->id }}" class="block">
                    <h3 class="font-bold text-gray-900 mb-2 hover:text-soya-red transition-colors line-clamp-2">
                        {{ $product->name }}
                    </h3>
                </a>
                
                <!-- Rating -->
                <div class="flex items-center mb-2 text-sm">
                    <span class="text-soya-yellow">⭐⭐⭐⭐⭐</span>
                    <span class="text-gray-500 ml-1">(4.8)</span>
                </div>
                
                <!-- Price & Stock -->
                <div class="flex items-center justify-between mb-3">
                    <span class="text-2xl font-bold text-soya-red">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    @if($product->stock > 10)
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Stok: {{ $product->stock }}</span>
                    @elseif($product->stock > 0)
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Sisa {{ $product->stock }}</span>
                    @else
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">Habis</span>
                    @endif
                </div>
                
                <!-- Button -->
                <a href="/products/{{ $product->id }}" 
                   class="block w-full bg-soya-red text-white text-center py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <div class="text-6xl mb-4">😢</div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Produk tidak ditemukan</h3>
            <p class="text-gray-500 mb-4">Coba kata kunci lain atau reset filter</p>
            <a href="/products" class="inline-block bg-soya-red text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700">
                Reset Filter
            </a>
        </div>
        @endforelse
    </div>
</div>

@endsection